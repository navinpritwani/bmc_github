
<?php
/* Set e-mail recipient */
$myemail  = "careers.vmrf@vedanta.co.in";

if(isset($_FILES['file']))
    {
        $tmp_name=$_FILES['image']['tmp_name'];
        $dest=$_FILES['image']['name'];	
        move_uploaded_file($tmp_name, "upload/".$dest);
    }

/* Check all form inputs using check_input function */
$yourname = check_input($_POST['form_name']);
$subject  = 'Job Enquiry from Balco Medical Centre Website';
$email    = check_input($_POST['form_email']);
$phone  = check_input($_POST['form_phone']);
$msg   = check_input($_POST['form_message']);
$qualification   = check_input($_POST['form_qualification']);
$experience   = check_input($_POST['form_experience']);
$employer   = check_input($_POST['form_employer']);
$rexperience   = check_input($_POST['form_rexperience']);
$gender   = check_input($_POST['form_sex']);
$resume = check_input($_POST['image']);

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}

/* If URL is not valid set $website to empty */
// if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $website))
// {
//     $website = '';
// }

/* Let's prepare the message for the e-mail */
$message = "Hello!

New Job enquiry form has been submitted by:

Name: $yourname
E-mail: $email
phone no : $phone
Qualification : $qualification
Experience : $rexperience
Gender : $gender
Current or Last Employer : $employer
Resume : http://balcomedicalcentre.com/includes/uploads/$resume
Message: $msg

End of message
";

$headers = "MIME-Version: 1.0\r\nContent-type: text/plain; charset=UTF-8\r\n";	
	$headers .= "From: careers@balcomedicalcentre.com\n";
	$headers .= "Reply-To: $email";	
/* Send the message using mail() function */
mail($myemail, $subject, $message, $headers);

/* Redirect visitor to the thank you page */
header('Location: ../thanks.htm');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;   
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>