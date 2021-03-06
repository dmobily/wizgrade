<?php

/*  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 	
	wizGrade V 1.2 (Formerly SDOSMS) is Designed & Developed by Igweze Ebele Mark | https://www.iem.wizgrade.com
	https://www.wizgrade.com
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 	
	Copyright 2014 - 2020 c wizGrade | IGWEZE EBELE MARK 
	
	Licensed under the Apache License, Version 2.0 (the "License");
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

		http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an "AS IS" BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
	wizGrade School App is Dedicated To Almighty God, My Amazing Parents ENGR Mr & Mrs Igweze Okwudili Godwin, 
	To My Fabulous and Supporting Wife Mrs Igweze Nkiruka Jennifer
	and To My Inestimable Sons Osinachi Michael, Ifechukwu Othniel and Naetochukwu Ryan.  
	
	WEBSITE 					PHONES												EMAILS
	https://www.wizgrade.com	+234 - 80 - 30 716 751, +234 - 80 - 22 000 490 		info@wizgrade.com	
	
	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Page/Code Explanation~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	This script handle school expense 
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		if (!defined('wizGrade'))

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
			require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>		
			
				<!-- row -->
				<!-- row -->	
					<div class="row">  
					<div class="col-sm-12">
					<section class="panel">
					<header class="panel-heading">
						<i class="fa fa-wrench fa-lg"></i> Expense Manager
						<span class="tools pull-right">
						<a href="javascript:;" class="fa fa-chevron-down"></a>
						<a href="javascript:;" class="fa fa-times"></a>
						</span>
					</header>
					<div class="panel-body wizGrade-line"> 

						<!--tab nav start-->
						<section class="panel">
						<header class="panel-heading tab-bg-dark-navy-blue" id="scrollTarget">
						<ul class="nav nav-tabs nav-justified">
						<li class="active">
						<a data-toggle="tab" href="#viewExp">
						<i class="fa fa-home"></i>
						School Expenses 
						</a>
						</li>

						<li>
						<a data-toggle="tab" href="#addExpenses">
						<i class="fa fa-plus-square"></i>
						Add New Payment
						</a>
						</li>
						</ul>
						</header>
						<div class="panel-body">
						<div class="tab-content"> 

							<div id="viewExp" class="tab-pane active"> 
								<div id='start' style="display: none;"></div> <div id='end' style="display: none;"></div>

								<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; 
								border: 1px solid #ccc; width:auto; ">
								<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
								<span></span> <b class="caret"></b> 
								 
								</div> 

								<br clear="all" />
								<div id="viewExpenses"> <?php require 'wizGradeExpensesInfo.php';  ?> </div>							  
							</div> 								  


							<div id="addExpenses" class="tab-pane">

								<!-- row -->
								<!-- row -->	
					<div class="row">  
									<div class="col-lg-10"> 

									<br clear="all" />
									<span id="eAmount" class="display-none"></span>
									<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="saveLoader"  
									style="cursor:pointer; display:none; margin-bottom:5px;" /></center>

									<div id="hmsgBox"> </div>

										<!-- form -->									
										<!-- form --><form class="form-horizontal" id="frmsaveExpenses" role="form">


										<div class="form-group">
										<label for="expenseCat" class="col-lg-4 col-sm-4 control-label">* Expense Category</label>

										<div class="col-lg-8">
										<div class="iconic-input">
										<i class="fa fa-sort-alpha-asc"></i>

										<select class="form-control"  id="expenseCat" name="expenseCat" required>

											<option value = "">Please select One</option>

											<?php


												try {

													$expenseCategoryDataArr = expenseCategoryData($conn);  /* school expenses category array */
													$expenseCategoryDataCount = count($expenseCategoryDataArr);
													
												}catch(PDOException $e) {
												
														wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
												 
												}		
											 
											if($expenseCategoryDataCount >= $fiVal){	/* check array is empty */	 

												for($i = $fiVal; $i <= $expenseCategoryDataCount; $i++){	/* loop array */	
												
													$eID = $expenseCategoryDataArr[$i]["e_id"];
													$expenseCategory = $expenseCategoryDataArr[$i]["expense"];
													
													$expenseCategory = trim($expenseCategory); 
													
													echo '<option value="'.$eID.'"'.$selected.'>
													'.$expenseCategory.'</option>' ."\r\n";

												}
											}else{
												
													echo '<option value="">Oooooooops Error, could not find fee category.</option>' ."\r\n"; 
												
											}	



											?>


										</select>


										</div>
										</div>
										</div>


										<span id="wait" style="display: none;">
										<center><img alt="Please Wait" src="loading.gif"/> <!-- loading image --></center> <!-- loading image --><!-- loading image-->
										</span>
										<span id="result" style="display: none;"></span><!-- loading div -->

										<div id="expenseDetailsDiv" style="display:none;"> 

											<span id="wait_1" style="display: none;">
											<center><img alt="Please Wait" src="loading.gif"/> <!-- loading image --></center> <!-- loading image --> <!-- loading image-->
											</span>
											<span id="result_1" style="display: none;"></span> <!-- loading div --> <!-- loading div --> 

											<div class="form-group" >
												<label for="title" class="col-lg-4 col-sm-4 control-label"> Expense Title</label>

												<div class="col-lg-8">

												<div class="iconic-input">
												<i class="fa fa-comment"></i>

												<input type="text" class="form-control" placeholder="Enter Expense Title" 
												name="title"  id="title" required>

												</div>

												</div>
											</div> 

											<div class="form-group" >
												<label for="amount" class="col-lg-4 col-sm-4 control-label">* Expense Amount</label>

												<div class="col-lg-8">

												<div class="iconic-input">
												<i class="fa fa-money"></i>

												<input type="number" class="form-control" placeholder="Enter Expense Amount" 
												name="eAmount"  id="eAmount" <?php echo $eAmount; ?> required>

												</div>

												</div>
											</div> 

											<div class="form-group">
												<label  for="method" class="col-lg-4 col-sm-4 control-label">* Payment Method</label>

												<div class="col-lg-8">
												<div class="iconic-input">
												<i class="fa fa-bars"></i>

												<select class="form-control"  id="method" name="method" required>

												<option value = "">Please select One</option>
													<?php


													foreach($paymentMethodArr as $methodKey => $methodVal){  /* loop array */

														if ($method == $methodKey){

															$selected = "SELECTED";

														} else {

															$selected = "";

														}

														echo '<option value="'.$methodKey.'"'.$selected.'>'.$methodVal.'</option>' ."\r\n";

													}

													?> 

												</select>

												</div>
												</div>
											</div> 

											<div class="form-group">
												<label for="expDetails" class="col-lg-4 col-sm-4 control-label"> &nbsp;&nbsp; Payment Details</label>

												<div class="col-lg-8">

												<textarea rows="4" cols="10" class="form-control" name="expDetails" id="expDetails" 
												placeholder="Payment Details eg Bank Name, Teller ID, Cheque ID, Card Type "></textarea>

												</div>
											</div> 


											<div class="form-group">
												<label class="control-label col-lg-4 col-sm-4">* Payment Date:</label>
												<div class="col-lg-7 col-sm-7">
													<div data-date-viewmode="years" data-date-format="yyyy-mm-dd" 
													data-date="2012-12-02"  
													class="input-append date dpYears">
													<input type="text" readonly="" 
													value="<?php echo $pDay; ?>" 
													size="10" class="form-control"  name="pDay"  required />
													<span class="input-group-btn add-on">
													<button class="btn btn-danger" type="button">
													<i class="fa fa-calendar"></i></button>
													</span>
													</div>
													<span class="help-block">Select date</span>
												</div>
											</div> 

											<div class="form-group">
												<input type="hidden" name="expensesData" value="savePayment" /> 
												<center><button type="submit" class="btn btn-danger buttonMargin" id="saveExpenses">
												<i class="fa fa-save"></i> Save Payment </button></center>
											</div>

										</div>
										
										</form><!-- / form --> 
										<!-- /form -->

									</div>  								  

									</div>  
								</div>
								<!-- / row -->

						</div>
						</div>
						</section>
						<!--tab nav start--> 

					</div>
					</section>
					</div>

				</div>
				<!-- / row -->
				
				<!-- expense removal pop up modal start -->
				<a href="#removeModal" data-toggle="modal" id="modalRemoveBtn" class=""> </a>

				<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" 
						data-dismiss="modal" aria-hidden="true">
						<span style='color:#fff !important;'>&times;</span></button>
						<h4 class="modal-title"> Are sure you want to remove this expenses information ?
						</h4>
					</div>
					<div class="modal-body"> 

						<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="removeLoader"  
						style="cursor:pointer; display:none; margin-bottom:5px;" /></center>

						<div id="removeMsg"> </div> 

						<div class="slideUpFrmDiv">

							<section class="panel">

							<div class="panel-body">

							<div id="removeHData" style="display:none;"></div>

								<?php 

								echo "$infoMsgNX  Are sure you want to remove? <br />
								<span style='color:#000;font-weight:bold;'  id='removeInfo'> </span> $msgEnd";
								?> 

							</div>

							</section>

						</div>

					</div>
					<div class="modal-footer slideUpFrmDiv">
						<button  class="btn btn-danger demoDisenable" id="removeExpenses" 
						type="button">Yes</button>
						<button data-dismiss="modal" class="btn btn-danger" 
						type="button">Cancel</button>
					</div>
					</div>
				</div>
				</div>
				<!-- expense removal pop up modal end -->

				<!-- expense edit pop up modal start -->
				<a href="#editModal" data-toggle="modal" id="modalEditBtn" class=""> </a>

				<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" 
						data-dismiss="modal" aria-hidden="true">
						<span style='color:#fff !important;'>&times;</span></button>
						<h4 class="modal-title"> Expenses Payment Manager
						</h4>
					</div>
					<div class="modal-body modal-body-scroll"> 

						<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="editLoader"  
						style="cursor:pointer; display:none; margin-bottom:5px;" /></center>

						<div id="editMsg"> </div> 

						<div class="slideUpFrmUDiv">

						<section class="panel">

						<div class="panel-body"> 

							<div id="editExpensesDiv"></div> 
						
						</div>

						</section>

						</div>

					</div>
					<div class="modal-footer slideUpFrmDiv">

						<button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
						
					</div>
					</div>
				</div>
				</div> 
				<!-- expense edit pop up modal end -->			  
	
				<script type="text/javascript">
			  
					$(function() {  /* date range function from js plugin moment */ 
					
 
						var start = moment().subtract(1000, 'days');
						var end = moment();

						function cb(start, end) {
							
							$('#reportrange span').html('<b><i>Search Expense By Date</i></b>: ' +start.format('MMMM D, YYYY') + 
							' <b><i>To</i></b> ' + end.format('MMMM D, YYYY'));
													
							
							$('#start').html(start.format('YYYY-M-D'));
							$('#end').html(end.format('YYYY-M-D'));
							if((start != "") || (end != "")){
								
								expenseRange();
								
							}	
							
						}
						
						$('#reportrange').daterangepicker({
							startDate: start,
							endDate: end,
							ranges: {
							   'Today': [moment(), moment()],
							   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
							   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
							   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
							   'Last 90 Days': [moment().subtract(87, 'days'), moment()],
							   'This Month': [moment().startOf('month'), moment().endOf('month')],
							   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
							}
						}, cb);

						cb(start, end); 
						
					});
					
					
					
					function expenseRange(){   /* expense date range */
														
						showPageLoader();
						
						var postVal = 'dateRange';
						var start = $('#start').text();
						var end = $('#end').text();
						
						$('#viewExpenses').load('wizGradeExpensesInfo.php', {'expensesData': postVal, 'expensesTo': end, 
							'expensesFrom':start});				
						
						return false;  
			
					}
					
					$('.dpYears').datepicker(); 
				 
				</script>
			  
			  