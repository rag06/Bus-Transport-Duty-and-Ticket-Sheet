
	<br/>
	<table   cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
		<thead>
			<tr>
				<th style="border: 1px solid black;">Ticket</th>
				<th style="border: 1px solid black;">Quantity</th>
				<th style="border: 1px solid black;">Amount</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$total = 0;
		$grdqty=0;
		foreach($tickets as $ticketRow) {
			$price = $ticketRow->tickets_Price+$ticketRow->tickets_ExtraPrice;
			$amt = ($ticketRow->qty* $price);
			$total += $amt;
			$grdqty+= $ticketRow->qty;
			?>

			<tr>
				<td style="border: 1px solid black;"><?php echo $ticketRow->tickets_Price;?> + <?php echo $ticketRow->tickets_ExtraPrice;?> =  <?php echo $price ;?></td>
				<td style="border: 1px solid black;"><?php echo $ticketRow->qty;?></td>
				<td style="border: 1px solid black;"><?php echo $amt;?></td>
			</tr>
			
<?php	} ?>
		</tbody>
		<tfoot>
			<tr>
				<td  style="border: 1px solid black;">Total</td>
				<td style="border: 1px solid black;"><?php echo $grdqty;?></td>
				<td style="border: 1px solid black;"><?php echo $total;?></td>
			</tr>
		</tfoot>
	</table>
	
									