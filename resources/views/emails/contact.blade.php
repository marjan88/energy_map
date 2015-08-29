<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
</head>
<body>

	<div>
            <p>This email was sent from the contact form of the Energien plant site.</p>
            <p>
                <?php if(isset($text)):
                echo $text;
                endif;
                ?>
            </p>
            <p>From: {{$name}}</p>
            
	</div>
</body>
</html>
