<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title pull-left">Chi tiết đặt chỗ</span>
        <input type="hidden" id="currenturl" value="<?php echo current_url();?>" />
        <input type="hidden" id="baseurl" value="<?php echo base_url().$this->uri->segment(1);?>" />
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" >
                <input type="hidden" name="bookingid" id="bookingid" value="<?php echo $bdetails->id;?>" />
                <input type="hidden" name="refcode" id="refcode" value="<?php echo $bdetails->code;?>" />
                <input type="hidden" name="itemid" id="itemid" value="<?php echo $bdetails->itemid;?>" />
                <input type="hidden" name="subitem" id="subitem" value="<?php echo $bdetails->subItem->id;?>" />
                <input type="hidden" name="btype" id="btype" value="<?php echo $bdetails->module;?>" />
                <input type="hidden" name="currencysign" id="currencysign" value="<?php echo $app_settings[0]->currency_sign;?>" />
                <input type="hidden" name="commission" id="commission" class="<?php echo $commtype;?>" value="<?php echo $commvalue;?>" />
                <input type="hidden" id="tax" class="<?php echo $tax_type; ?>" value="<?php echo $tax_val; ?>" />
                <input type="hidden" name="totalsupamount" id="totalsupamount" value="<?php echo $supptotal;?>" />
                <?php if($service == "hotels"){ ?>
                <input type="hidden" name="totalamount" id="totalroomamount" value="<?php echo $rtotal;?>" />
                <?php  } ?>
                <input type="hidden" name="grandtotal" id="alltotals"  value="<?php echo $bdetails->checkoutTotal;?>" />
                <input type="hidden" name="paymethod" id="methodname"  value="<?php echo $bdetails->paymethod;?>" />
                <input type="hidden" name="paymethodfee" id="paymethodfee"  value="0" />
                <input type="hidden" name="checkin" id="cin"  value="<?php echo $bdetails->checkin;?>" />
                <input type="hidden" name="checkout" id="cout"  value="<?php echo $bdetails->checkout;?>" />
                <input type="hidden" name="commissiontype" id="comtype" value="<?php echo $commtype;?>" />
                <input type="hidden" id="apptax" value="<?php echo $applytax;?>" />
                <input type="hidden" name="paidamount" value="<?php echo $bdetails->amountPaid;?>" />
                <?php if(!empty($service)){  ?>
                <div class="panel panel-default">
                
                    <h3><b>Mã đơn hàng</b></h2> 
                    <br/>



					<div class="panel panel-default">

						<div class="panel-heading">
							<strong>Tình trạng</strong>
						</div>
						<div class="panel-body" style="padding-left: 50px">
							<h5>
								<b><font color="red"> Chưa xử lý</font></b>
							</h5>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<strong>Ghi chú</strong>
						</div>
						<div class="panel-body" style="padding-left: 50px">
							<h5>* cần chi tiết hóa đơn đỏ</h5>
						</div>
					</div>


					<div class="panel-heading"><strong>Mã giữ chỗ thật</strong></div>
                    <div class="panel-body" style="padding-left: 50px">

						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Hãng</th>
									<th>Hành trình</th>
									<th>Ngày đi</th>
									<th>Trạng Thái</th>
									<th>Chi tiết</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row"><b>Jet</b><font size="3" color="red">&#x2605;</font></th>
									<td>Ha Noi(HAN) - Ho Chi Minh City (SGN)</td>
									<td>08 FEB</td>
									<td>Đang xử lý</td>
									<td>-</td>
								</tr>
							</tbody>
						</table>
                    </div>
                </div>
			<div class="panel panel-default">


				<div class="panel-heading">
					<strong>Hành trình</strong>
				</div>
				<div class="panel-body" style="padding-left: 50px">

					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Hãng</th>
								<th>Hành trình</th>
								<th>Ngày đi</th>
								<th>Giờ đi</th>
								<th>Giờ đến</th>
								<th>Hạng</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row"><b>Jet</b><font size="3" color="red">&#x2605;</font></th>
								<td>Ha Noi(HAN) - Ho Chi Minh City (SGN)</td>
								<td>08 FEB</td>
								<td>05:45</td>
								<td>07:50</td>
								<td>Starter (E)</td>
							</tr>
									<tr>
								<th scope="row"><b>Jet</b><font size="3" color="red">&#x2605;</font></th>
								<td>Ho Chi Minh City (SGN) - Ha Noi(HAN)</td>
								<td>11 FEB</td>
								<td>05:00</td>
								<td>07:51</td>
								<td>Starter (Y)</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel panel-default">

				<div class="panel-heading">
					<strong>Thông tin hành khách</strong>
				</div>
				<div class="panel-body" style="padding-left: 50px">

					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Hành Khách</th>
								<th>Quý danh</th>
								<th>Họ</th>
								<th>Đệm và Tên</th>
								<th>Hgày sinh</th>
								<th>Hành lý</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Người lớn</td>
								<td>Mr</td>
								<td>Trần</td>
								<td>Thanh Tú</td>
								<td>02/05/1959</td>
								<td><a>Xem hành lý</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			
			
			<div class="panel panel-default">

				<div class="panel-heading">
					<strong>Thông tin giá</strong>
				</div>
				<div class="panel-body" style="padding-left: 50px">

					<table class="table table-bordered">
						<thead>
							<tr>
								<th></th>
								<th>Giá vé</th>
								<th>Phí</th>
								<th>Phí dịch vụ</th>
								<th>Khuyến mãi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>Người lớn</th>
								<td>6,250,000 VND</td>
								<td>300,000 VND</td>
								<td>0 VND</td>
								<td>0 VND</td>
							</tr>
							<tr>
								<th>Trẻ em</th>
								<td>0 VND</td>
								<td>0 VND</td>
								<td>0 VND</td>
								<td>0 VND</td>
							</tr>
							<tr>
								<th>Em bé </th>
								<td>0 VND</td>
								<td>0 VND</td>
								<td>0 VND</td>
								<td>0 VND</td>
							</tr>
						</tbody>
					</table>
					<div class="form-group">
						<div class="col-md-2">Giá vé</div>
						<div class="col-md-4">6,250,000 VND</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-2">Phí</div>
						<div class="col-md-4">300,000</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">Hành lý</div>
						<div class="col-md-4">500,000 VND</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-2">Khuyễn mãi</div>
						<div class="col-md-4">-0 VND</div>
					</div>
					<div class="form-group">
						<div class="col-md-2">Phí thanh toán</div>
						<div class="col-md-4">0 VND</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-2">Tông giá</div>
						<div class="col-md-4">7,050,000 VND</div>
					</div>

				</div>
			</div>


			<div class="panel panel-default">

				<div class="panel-heading">
					<strong>Thông tin thanh toán</strong>
				</div>
				<div class="panel-body" style="padding-left: 50px">

					<div class="form-group">
						<div class="col-md-2">Hình thức thanh toán</div>
						<div class="col-md-4">chuyển khoản</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-2">Tên người nhận</div>
						<div class="col-md-4"></div>
					</div>
					
					<div class="form-group">
						<div class="col-md-2">Địa chỉ người nhận</div>
						<div class="col-md-4"></div>
					</div>
					
					<div class="form-group">
						<div class="col-md-2">Điện thoại người nhận</div>
						<div class="col-md-4"></div>
					</div>
					
					<div class="form-group">
						<div class="col-md-2">Thời gian giao vé thích hợp nhất</div>
						<div class="col-md-4">05 MAR </div>
					</div>

				</div>
			</div>


			<div class="panel panel-default">

				<div class="panel-heading">
					<strong>Thông tin liên hệ</strong>
				</div>
				<div class="panel-body" style="padding-left: 50px">

					<div class="form-group">
						<div class="col-md-2">Tên khách hàng</div>
						<div class="col-md-4">Tú</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">Địa chỉ</div>
						<div class="col-md-4">Nội bài Hà nội </div>
					</div>

					<div class="form-group">
						<div class="col-md-2">Địa chỉ email</div>
						<div class="col-md-4">abcdef@gmail.com</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">Điện thoại</div>
						<div class="col-md-4">0123456789</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">Ghi chú</div>
						<div class="col-md-4">gửi lại chi tiết hóa đơn đỏ</div>
					</div>

				</div>
			</div>
			
			<div class="panel panel-default">

				<div class="panel-heading">
					<strong>Ngày đặt</strong>
				</div>
				<div class="panel-body" style="padding-left: 50px">
						<b>06/02/2018 12:19:00 SA</b>
				</div>
			</div>

		
			<div class="panel panel-default">

				<div class="panel-heading">
					<strong>Địa chỉ IP</strong>
				</div>
				<div class="panel-body" style="padding-left: 50px">
						<b>14.231.26.150</b>
				</div>
			</div>


<!--                 <div class="form-group"> -->
<!-- 					<div class="col-md-12"> -->
<!-- 						<input type="hidden" name="updatebooking" value="1" /> <input -->
<!-- 							type="submit" class="btn btn-primary btn-block btn-lg" -->
<!-- 							value="Update Booking"> -->
<!-- 					</div> -->
<!-- 				</div> -->
                <?php } ?>
            
		</form>
        </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/adminbooking.js"></script>
