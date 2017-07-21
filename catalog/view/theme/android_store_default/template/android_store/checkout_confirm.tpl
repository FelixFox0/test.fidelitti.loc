<?php if (!isset($redirect)) { ?>
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <td class="text-left"><?php echo $column_name; ?></td>
        <td class="text-right hidden-xs"><?php echo $column_quantity; ?></td>
        <td class="text-right hidden-xs"><?php echo $column_price; ?></td>
        <td class="text-right"><?php echo $column_total; ?></td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) { ?>
      <tr>
        <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
          <?php if ($product['model']) { ?>
		  <br />
          <small>(<?php echo $product['model']; ?>)</small>
		  <?php } ?>
		  <?php foreach ($product['option'] as $option) { ?>
          <br />
          &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
          <?php } ?>
          <?php if($product['recurring']) { ?>
          <br />
          <span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
          <?php } ?>
		  <br />
          <small class="visible-xs"><?php echo $column_quantity; ?>: <?php echo $product['quantity']; ?></small>		  
          <small class="visible-xs"><?php echo $column_price; ?>: <?php echo $product['price']; ?></small>		  
		</td>
        <td class="text-right hidden-xs"><?php echo $product['quantity']; ?></td>
        <td class="text-right hidden-xs"><?php echo $product['price']; ?></td>
        <td class="text-right"><?php echo $product['total']; ?></td>
      </tr>
      <?php } ?>
      <?php foreach ($vouchers as $voucher) { ?>
      <tr>
        <td class="text-left">
			<?php echo $voucher['description']; ?>
			<br />
			<small class="visible-xs"><?php echo $column_quantity; ?>: 1</small>		  
            <small class="visible-xs"><?php echo $column_price; ?>: <?php echo $voucher['amount']; ?></small>	
		</td>
        <td class="text-right hidden-xs">1</td>
        <td class="text-right hidden-xs"><?php echo $voucher['amount']; ?></td>
        <td class="text-right"><?php echo $voucher['amount']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <?php foreach ($totals as $total) { ?>
      <tr>
        <td colspan="3" class="text-right hidden-xs"><strong><?php echo $total['title']; ?>:</strong></td>
        <td class="text-right visible-xs"><strong><?php echo $total['title']; ?>:</strong></td>
        <td class="text-right"><?php echo $total['text']; ?></td>
      </tr>
      <?php } ?>
    </tfoot>
  </table>
</div>
<?php echo $payment; ?>
<?php } else { ?>
<script type="text/javascript"><!--
location = '<?php echo $redirect; ?>';
//--></script>
<?php } ?>
