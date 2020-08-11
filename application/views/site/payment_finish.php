<?php
echo "<pre>";
print_r ($transaction);
echo "</pre>";

switch ($transaction->payment_type) {
	case 'credit_card':
		// code...
	break;

	case 'cstore':
	?>

	<?php
	break;
	
	default:
		// code...
		break;
}
?>