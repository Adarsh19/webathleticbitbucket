<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Package Invoice</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
				
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<!-- Web Fonts  -->		
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
		
		<!-- <link rel="stylesheet" rel="stylesheet" type="text/css" href="<?php echo e(asset('admin_files/vendor/bootstrap/css/bootstrap.css')); ?>" />-->
		<link rel="stylesheet" href="<?php echo e(asset('admin_files/css/theme.css')); ?>" />
	</head>
	<body style="background-color:#FFFFFF;" class="body">
		<section class="card">
			<div class="card-body">
				<div class="invoice">
					<header class="clearfix">
						<div class="row">
							<div class="col-sm-6 mt-3">
								<h2 class="h2 mt-0 mb-1 text-dark font-weight-bold">Factuurnummer</h2>
								<h4 class="h4 m-0 text-dark font-weight-bold">#<?php echo e($invoice->invoice_number); ?></h4>
							</div>
							<div class="col-sm-6 text-right mt-3 mb-3">
								<address class="ib mr-5">
									<?php echo e($company->company_name); ?>

									<br>
									<?php echo e($company->address); ?> <?php echo e($company->zipcode); ?>

									<br>
									Phone: <?php echo e($company->phone); ?>

									<br>
									<?php echo e($company->email); ?>

								</address>
								<div class="ib">
									<img src="<?php echo e(asset('admin_files/img/invoice-logo.png')); ?>" alt="">
								</div>
							</div>
						</div>
					</header>
					<div class="bill-info">
						<div class="row">
							<div class="col-md-6">
								<div class="bill-to">
									<p class="h5 mb-1 text-dark font-weight-semibold">To:</p>
									<address>
										<?php echo e($user->name); ?>

										<br>
										<?php echo e($user->address); ?>

										<br>
										Phone: <?php echo e($user->phone); ?>

										<br>
										<?php echo e($user->email); ?>

									</address>
								</div>
							</div>
							<div class="col-md-6">
								<div class="bill-data text-right">
									<p class="mb-0">
										<span class="text-dark">Factuurdatum:</span>
										<span class="value"><?php echo date('m/d/Y', strtotime($invoice->invoice_date)); ?></span>
									</p>
									<p class="mb-0">
										<span class="text-dark">Verloopdatum:</span>
										<span class="value"><?php echo date('m/d/Y', strtotime($invoice->due_date)); ?></span>
									</p>
								</div>
							</div>
						</div>
					</div>

					<table class="table table-responsive-md invoice-items">
						<thead>
							<tr class="text-dark">
								<th id="cell-id" class="font-weight-semibold">#</th>
								<th id="cell-item" class="font-weight-semibold">Abbonement</th>
								<th id="cell-desc" class="font-weight-semibold">Omschrijving</th>
								<th id="cell-price" class="text-center font-weight-semibold">Prijs</th>
								<th id="cell-qty" class="text-center font-weight-semibold">Aantal</th>
								<th id="cell-total" class="text-center font-weight-semibold">Totaal</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo e($package->id); ?></td>
								<td class="font-weight-semibold text-dark"><?php echo e($package->name); ?></td>
								<td><?php echo e($package->sell_category); ?></td>
								<td class="text-center"><?php echo e($package->sell_category); ?></td>
								<td class="text-center"><?php echo e($invoice->quantity); ?></td>
								<td class="text-center">$<?php echo e($invoice->total_amount); ?></td>
							</tr>						
						</tbody>
					</table>					
					<div class="invoice-summary">
						<div class="row justify-content-end">
							<div class="col-sm-4">
								<table class="table h6 text-dark">
									<tbody>
										<tr class="b-top-0">
											<td colspan="2">Subtotaal</td>
											<td class="text-left">$<?php echo e($invoice->total_amount); ?></td>
										</tr>										
										<tr class="h4">
											<td colspan="2">Eindtotaal</td>
											<td class="text-left">$<?php echo e($invoice->total_amount); ?></td>
										</tr>
									</tbody>
								</table>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>