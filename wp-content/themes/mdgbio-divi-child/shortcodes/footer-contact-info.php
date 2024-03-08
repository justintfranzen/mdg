<?php
function contact_information_shortcode($atts)
{
  // Shortcode attributes.
  $a = shortcode_atts(
    [
      'phone' => 'phonenumber',
      'email' => 'emailaddress',
      'address' => 'location',
    ],
    $atts,
  );
  ob_start();
  ?>

        <div class="contact-info">
	        <p class="phone contact"><?php echo $a['phone']; ?></p>
	        <p class="email contact"><?php echo $a['email']; ?></p>
	        <p class="address contact"><?php echo $a['address']; ?></p>
        </div>


    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

function register_contact_information_shortcode()
{
  add_shortcode('contact_information', 'contact_information_shortcode');
}

?>
