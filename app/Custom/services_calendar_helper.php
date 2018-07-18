<?php

use App\Service;
use App\ServiceEventExceptions;
use App\ServiceScheduleEvents;
use Illuminate\Support\Facades\DB;
use When\When;

function get_day_names_from_digit($digitscommaseparated)
{
    $exp=explode(",", $digitscommaseparated);
    $days=array();
    foreach ($exp as $day) {
        switch ($day) {
            case 0:
                $days[$day]="Sun";
                break;
            case 1:
                $days[$day]="Mon";
                break;
            case 2:
                $days[$day]="Tue";
                break;
            case 3:
                $days[$day]="Wed";
                break;
            case 4:
                $days[$day]="Thr";
                break;
            case 5:
                $days[$day]="Fri";
                break;
            case 6:
                $days[$day]="Sat";
                break;
        }
    }
    return $days;
}


function getExceptionDates($event_id)
{

    $exdates=ServiceEventExceptions::where('event_id', $event_id)->get();
    return $exdates;
}


function generateInstances($event, $viewStartDate, $viewEndDate)
{


    //global $mappings, $date_format, $exception_format, $max_event_instances;
    $max_event_instances = 99;
    $date_format = 'Y-m-d H:i:s';
    $exception_format = 'Y-m-d H:i:s';
    $rrule_date_format = 'Ymd\\THis\\Z';
    $mappings = array(
        // Basic event properties. This is not all properties, only those needed explicitly
        // while processing recurrence. The others are read and set generically.
        'event_id'   => 'id',
        'start_date' => 'start',
        'end_date'   => 'end',

        // Recurrence-specific properties needed for processing recurring events:
        'rrule'                => 'rrule',
        'duration'             => 'duration',
        'orig_event_id'        => 'origid',
        'recur_edit_mode'      => 'redit',
        'recur_instance_start' => 'ristart',
        'recur_series_start'   => 'rsstart',

        // Recurrence exceptions
        'exdate' => 'exdate'
    );




    $rrule = $event[$mappings['rrule']];

    $instances = array();
    $counter = 0;

    // Get any exceptions for this event. Ideally you would join exceptions
    // to events at the event query level and not have to do a separate select
    // per event like this, but for the demos this is good enough.


    $exceptions = getExceptionDates($event[$mappings['event_id']]);


    if (!isset($rrule) || $rrule === '') {
        array_push($instances, $event);
    } else {
        $duration = $event[$mappings['duration']];

        if (!isset($duration)) {
            // Duration is required to calculate the end date of each instance. You could raise
            // an error here if appropriate, but we'll just be nice and default it to 0 (i.e.
            // same start and end dates):
            $duration = 0;
        }



        // Start parsing at the later of event start or current view start:
        $rangeStart = max($viewStartDate, $event[$mappings['start_date']]);
        //$rangeStart = self::adjustRecurrenceRangeStart($rangeStart, $event);
        $rangeStartTime = strtotime($rangeStart);

        // Stop parsing at the earlier of event end or current view end:
        $rangeEnd = min($viewEndDate, $event[$mappings['end_date']]);
        $rangeEndTime = strtotime($rangeEnd);

        // Third-party recurrence parser -- see recur.php




        $recurrence = new When();
        $recurrence->startDate(new DateTime($event[$mappings['start_date']]))
            ->rrule($rrule)
            ->generateOccurrences();

        $rdates=$recurrence->occurrences;







        // TODO: Using the event start date here is the correct approach, but is inefficient
        // based on the current recurrence library in use, which does not accept a starting
        // date other than the event start date. The farther in the future the view range is,
        // the more processing is required and the slower performance will be. If you can parse
        // only relative to the current view range, parsing speed is much faster, but it
        // introduces a lot more complexity to ensure that the returned dates are valid for the
        // recurrence pattern. For now we'll sacrifice performance to ensure validity, but this
        // may need to be revisited in the future.
        //$rdates = $recurrence->recur($rangeStart)->rrule($rrule);


        //$rdates = $recurrence->recur($event[$mappings['start_date']])->rrule($rrule);



//        echo "<pre>";
//        print_r($rdates);
//        exit;

        // Counter used for generating simple unique instance ids below
        $idx = 1;
        //$instances=array();
        // Loop through all valid recurrence instances as determined by the parser
        // and validate that they are within the valid view range (and not exceptions).
//        echo "<pre>";
//        echo " Rdates";
//        print_r($rdates);
//        exit;


        foreach ($rdates as $rdate) {
            $rtime = strtotime($rdate->format('c'));


            // When there is no end date or maximum count as part of the recurrence RRULE
            // pattern, the parser by default will simply loop until the end of time. For
            // this reason it is critical to have these boundary checks in place:
            if ($rtime < $rangeStartTime) {
                // Instance falls before the range: skip, but keep trying
                continue;
            }
            if ($rtime > $rangeEndTime) {
                // Instance falls after the range: the returned set is sorted in date
                // order, so we can now exit and return the current event set

                break;
            }

            // Check to see if the current instance date is an exception date
            $exmatch = false;
            foreach ($exceptions as $exception) {
                if ($exception[$mappings['exdate']] == $rdate->format($date_format)) {
                    $exmatch = true;
                    break;
                }
            };
            if ($exmatch) {
                // The current instance falls on an exception date so skip it
                continue;
            }

            // Make a copy of the original event and add the needed recurrence-specific stuff:
            $copy = $event;



            // First off, set the series start date on each instance for editing purposes
            $eventStart = new DateTime($event[$mappings['start_date']]);
            $copy[$mappings['recur_series_start']] = $eventStart->format($date_format);

            // On the client side, Ext stores will require a unique id for all returned events.
            // The specific id format doesn't really matter ($mappings['orig_event_id will be used
            // to tie them together) but all ids must be unique:
            $copy[$mappings['event_id']] = $event[$mappings['event_id']].'-rid-'.$idx++;

            // Associate the instance to its master event for later editing:
            $copy[$mappings['orig_event_id']] = $event[$mappings['event_id']];
            // Save the duration in case it wasn't already set:
            $copy[$mappings['duration']] = $duration;
            // Replace the series start date with the current instance start date:
            $copy[$mappings['start_date']] = $rdate->format($date_format);
            // By default the master event's end date will be the end date of the entire series.
            // For each instance, we actually want to calculate a proper instance end date from
            // the duration value so that the view can simply treat them as standard events:
            $copy[$mappings['end_date']] = $rdate->add(new DateInterval('PT'.$duration.'M'))->format($date_format);

            // Add the instance to the set to be returned:

//            print_r( $copy );

            array_push($instances, $copy);

            if (++$counter > $max_event_instances) {
                // Should never get here, but it's our safety valve against infinite looping.
                // You'd probably want to raise an application error if this happens.
                break;
            }
        }
    }

//    dd($instances);
    return $instances;
}

/**
 * Add a recurrence exception date for the given event id
 */
function addExceptionDate($event_id, $exception_date)
{
//    global $exception_format, $db;
//
//    $exdate = new DateTime($exception_date);
//    $exdate = $exdate->format($exception_format);

    $exdate = new DateTime($exception_date);
    //$exdate = $exdate
    $result=array();
    try {
        // Insert only if the event id + exdate doesn't already exist
        $ispresant=ServiceEventExceptions::where('event_id', $event_id)->where('exdate', $exdate)->first();
        if (empty($ispresant)) {
            $result=  ServiceEventExceptions::create([
                'event_id' => $event_id,
                'exdate'   => $exdate
            ]);
        } else {
            $result=$ispresant;
        }
    } catch (\TheSeer\Tokenizer\Exception $e) {
        print_r($e->getMessage());
    }


    return $result;
}

/**
 * Helper method that updates the UNTIL portion of a recurring event's RRULE
 * such that the passed end date becomes the new UNTIL value. It handles updating
 * an existing UNTIL value or adding it if needed so that there is only one
 * unqiue UNTIL value when this method returns.
 */
function endDateRecurringSeries($event, $endDate)
{
    //global $date_format, $rrule_date_format, $mappings;

    //$event['end'] = $endDate->format('c');

//    $date = new DateTime($endDate);
    //$event['end'] = $endDate->format('Y-m-d H:i:s');

//    $event['end'] = $endDate->format('Y-m-d H:i:s');


    //print_r($endDate->format('Y-m-d H:i:s'));
//    exit;

    $parts = explode(';', $event['rrule']);
    $newRrule = array();
    $untilFound = false;

    foreach ($parts as $part) {
        if (strrpos($part, 'UNTIL=') === false) {
            array_push($newRrule, $part);
        }
    }
    array_push($newRrule, 'UNTIL='.$endDate->format('Y-m-d H:i:s'));
    $event['rrule'] = implode(';', $newRrule);


    return $event;
}

/**
 * Remove any extra attributes that are not mapped to db columns for persistence
 * otherwise MySQL will throw an error
 */
function cleanEvent($event)
{

//    unset($event['orig_event_id']);
    unset($event['days']);
    unset($event['service']);
    unset($event['date_from']);
    unset($event['date_untill']);
    unset($event['time_untill']);
    unset($event['time_from']);
    unset($event['orig_event_id']);
    unset($event['service_id']);
    unset($event['user_name']);
    unset($event['service']);
    unset($event['month']);
    unset($event['monthday']);
    unset($event['recurringtype']);
    unset($event['numberrecur']);
    unset($event['date_form_recur']);
    unset($event['yearday']);
    unset($event['countuingselect']);
    unset($event['date_untill_recur']);
    unset($event['end_date']);
    unset($event['recur_edit_mode']);
    unset($event['recur_edit_mode']);
    unset($event['recur_instance_start']);
    unset($event['recur_series_start']);
    unset($event['recur_series_start']);

    return $event;
}

function insert($table, array $values)
{
    return save('INSERT', $table, $values);
}

function update($table, array $values)
{
    return save('UPDATE', $table, $values);

    // dd($values);
//     $allday=(isset($values['allday']))? 1: 0;
//     $dragable=(isset($values['dragable']))? true: false;
//     $canbook=(isset($values['book']))? '1': '0';
//     $url=(isset($values['url']))? $values['url']: '';
//     $reminder=(isset($values['url']))? $values['url']: '';
//     $start=$end="";
//     if(isset($values['allday'])){
//         echo $start = date('Y-m-d H:i:s', strtotime($values['date_from']));
//         echo  $end = date('Y-m-d H:i:s', strtotime($values['date_untill']));
//     }
//     else{
//         echo  $start = $values['date_from']." ".$values['time_from'];
//         echo  $end = $values['date_untill']." ".$values['time_untill'];
//     }
//     $date1Timestamp = strtotime($start);
//     $date2Timestamp = strtotime($end);
//     //$duration = $date2Timestamp - $date1Timestamp;
//     $duration=round(abs($date2Timestamp - $date1Timestamp) / 60,2)." minute";
//
//     echo $event_id=$values['orig_event_id'];
//     $servicemname=Service::select('service','bg_color')->where('id',$event_id)->first();
//
//     $update=ServiceScheduleEvents::where('id',$event_id)->update([
//
//         'title'=>$servicemname['service'],
//         'start'=> $start,
//         'end'=>$end,
//         'service_schedule_id'=>$values['schedule_id'],
//         'location'=>$values['location'],
//         'notes'=>$values['description'],
//         'url'=>$url,
//         'reminder'=>$reminder,
//         'duration'=>$duration,
//         'editable'=>$dragable,
//         'can_user_book'=>$canbook,
//         'rrule'=>$values['rule'],
//         'all_day'=>$allday,
//
//     ]);
//
//     dd($update);
}

function save($action, $table, array $values)
{
    $param_names = array();
    $param_mappings = array();
    $col_mappings = array();

    $valuesst="";
    $result="";

    foreach ($values as $col => $value) {
        $param = $col;
        array_push($param_names, $param);
        $param_mappings[] = $value;
//        $param_mappings[] =array('$col'=> $value);
        array_push($col_mappings, $col);

        if (strlen(trim($value))>0) {
            $valuesst.="`".$col."`='".$value."',";
        }
    }


    //$a=array_combine($col_mappings,$param_mappings);
//     print_r($valuesst);
//     exit;
    if ($action === 'INSERT') {
        $cols = implode(',', array_keys($values));
        $param_list = implode(',', $param_names);
        $sql = 'INSERT INTO '.$table.' ('.$cols.') VALUES ('.$param_list.')';
        $result=DB::insert($sql);
        //print_r( $result);
    } else {
        try {
            //print_r( $param_mappings);

            $cols = implode(',', $col_mappings);
            echo  $id = $values['id'];

            $valuesst=rtrim($valuesst, ",");

            $sql = 'UPDATE '.$table.' SET '.$valuesst.' WHERE id = '.$id;
//exit;
            $result=DB::insert($sql);

//
        } catch (\TheSeer\Tokenizer\Exception $e) {
            print_r($e->getMessage());
        }
    }

//    $this->connect();
//    $query = $this->db->prepare($sql);
//    $query->execute($param_mappings);
//    $id = $action == 'INSERT' ? $this->db->lastInsertId() : $id;
//    $result = $this->select($table, $id);


    return $result;
}

/**
 * Returns the duration of the event in minutes
 */
function calculateDuration($startDate, $endDate)
{


    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    $interval = $start->diff($end);
    $negative = $interval->invert === 1;

    $minutes = ($interval->days * 24 * 60) +
        ($interval->h * 60) +
        ($interval->i);

    return $negative ? -$minutes : $minutes;
}


/**
 * If the event is recurring, this function calculates the best
 * possible end date to use for the series. It will attempt to calculate
 * an end date from the RRULE if possible, and will fall back to the PHP
 * max date otherwise. The generateInstances function will still limit
 * the results regardless. For non-recurring events, it simply returns
 * the existing end date value as-is.
 */
function calculateEndDate($event)
{
    global $date_format, $mappings;

    $end = $event['end'];
    $rrule = $event['rule'];
    $isRecurring = isset($rrule) && $rrule !== '';

    if ($isRecurring) {
        $max_date = new DateTime('9999-12-31');
        $recurrence = new When();
        $recurrence->rrule($rrule);

        if (isset($recurrence->end_date) && $recurrence->end_date < $max_date) {
            // The RRULE includes an explicit end date, so use that
            $end = $recurrence->end_date->format($date_format).'Z';
        } elseif (isset($recurrence->count) && $recurrence->count > 0) {
            // The RRULE has a limit, so calculate the end date based on the instance count
            $count = 0;
            $newEnd;
            $rdates = $recurrence->recur($event[$mappings['start_date']])->rrule($rrule);

            while ($rdate = $rdates->next()) {
                $newEnd = $rdate;
                if (++$count > $recurrence->count) {
                    break;
                }
            }
            // The 'minutes' portion should match Extensible.calendar.data.EventModel.resolution:
            $newEnd->modify('+'.$event[$mappings['duration']].' minutes');
            $end = $newEnd->format($date_format).'Z';
        } else {
            // The RRULE does not specify an end date or count, so default to max date
            $end = date($date_format, mktime(0, 0, 0, 12, 31, 9999)).'Z';
        }
    }
    return $end;
}


function removeExceptionDates($event_id)
{
    $sql = 'DELETE FROM `service_event_exceptions` WHERE event_id = '.$event_id;
    $result=DB::delete($sql);
    return $result;
}

function public_permissions(){
    public_permissionsinner();
}
