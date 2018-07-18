<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyInvoice extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
    */
	protected $table = "company_invoices";
	
    /**
     * Primary Key
    */
    protected $primaryKey = 'company_invoice_id';
	
	
	protected $fillable = [
        'package_history_id','invoice_number', 'quantity', 'total_amount', 'invoice_date','due_date'
    ];
	
	public static $rules = [
        // Validation rules
    ];	
	
}
