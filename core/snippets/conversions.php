<?php

function pixelshop_conversion_pixel($order_id)
{
	$order 		= new WC_Order($order_id);
	$currency 	= $order->get_order_currency();
	$total 		= $order->get_total();
	$date 		= $order->order_date;
	$order_items = $order->get_items();

	foreach ($order_items as $order_item)
	{
		$products[] = $order_item['product_id'];
	}

	$pixelshop_id 	= get_option('pixelshop_id');

	if(isset($pixelshop_id) && $pixelshop_id != '')
	{
		$products = implode(',', $products);
		?>
			<script type="text/javascript" src="https://pixelshop.me/conversions/<?php echo $pixelshop_id; ?>?order_id=<?php echo $order_id; ?>&amp;revenue=<?php echo $total; ?>&amp;currency=<?php echo $currency; ?>&amp;products=<?php echo $products; ?>"></script>
		<?php
	}
}
add_action('woocommerce_thankyou', 'pixelshop_conversion_pixel');