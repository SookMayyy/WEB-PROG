<?php
include 'mysqli_connect.php';

if (isset($_POST['donation'])) {
       
    if (!isset($_SESSION['email'])) { ?>
        <script type="text/javascript">
            window.alert("Please login first to donate.");
            window.location='Login.php';
        </script>
    
<?php 
    } else {
        $userid = $_SESSION['user_id'];
        $amount = $_POST['amount'];
        $donationmethod = $_POST['donation_method'];
        
        //validation for amount 
        $price= "/^(?!0(\.00?)?$)[0-9]*(\.[0-9]{1,2})?$/";
        
        if (empty($amount) || empty($donationmethod)) { ?>
            <script type="text/javascript">
                window.alert("Please fill in all the fields");
                window.location='Donation.php#donate_payment';
            </script> <?php 
            
        } elseif (!preg_match($price, $amount)) { ?>
            <script type="text/javascript">
                window.alert("Donation amount must be numbers only and higher than zero. \nEg: 0.00 or RM10.00 is not allowed.");
                window.location='donation.php#donate_payment';
            </script> <?php 
            
        } else {
            
            $points_earned = floor($amount);
            
            // add earned point into users table
            $query1 = "UPDATE users SET point_balance = point_balance + $points_earned
                       WHERE user_id = $userid";
            mysqli_query($connectDB, $query1);
         
            // insert into donation table
            $SQLdonation ="INSERT INTO donation(user_id, amount, donation_method) 
                          VALUES ('$userid', '$amount', '$donationmethod');";
            $run = mysqli_query($connectDB, $SQLdonation);
            
            
            $SQL = "SELECT donation_id FROM donation WHERE user_id='$userid';";
            $data = mysqli_query($connectDB, $SQL);
            $retrieve = mysqli_fetch_array($data);
            
            $donation_id = $retrieve['donation_id'];

            // insert into rewards table
            $query2 = "INSERT INTO rewards (user_id, points, type, transaction_date, donation_id)
                       VALUES ('$userid', '$points_earned', 'earn', NOW(), '$donation_id')";
            mysqli_query($connectDB, $query2);
            
            // Update user's point balance
            $_SESSION['points_balance'] += $points_earned;
            
            if($run) { ?>
            	<script type="text/javascript">
                    window.alert("Thank you for the donation!\nYou earned " + <?php echo $points_earned; ?> + " points.");
                    window.location = 'donation.php#donate_payment';
                </script> <?php
            
            } else { ?>
                <script type="text/javascript">
                    alert("Failed to process your donation. Please try again.");
                    window.location = 'donation.php#donate_payment';
                </script>
        <?php
        }
        }
        
    }
}

?>
