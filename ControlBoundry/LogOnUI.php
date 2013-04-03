<?php
include_once("header.php");
/**
 * Description of LogOnUI
 *
 * @author Lincoln
 */
class LogOnUI 
{
    private $lblUserid;
    private $lblPassword;
    private $btnLogOn;
    private $btnForgotPassword;

    private $lblInstructions;
    private $lblEmail;
    private $btnResetPassword;
    private $btnBackToLogOn;
    
    
    public function __construct()
    {
        $this->lblUserid = "Userid";
        $this->lblPassword = "Password";
        $this->btnLogOn = "Login";
        $this->btnForgotPassword = "Forgot Password?";
        
        $this->lblInstructions = "To reset your password please provide your 
            email";
        $this->lblEmail = "Email";
        $this->btnResetPassword = "Reset Password";
        $this->btnBackToLogOn = "Back to Login";
    }
    
    public function displayLogOnUI()
    {
        ?>
        <form action='home.php' method='post'>
        <table>
            <tr> 
                <td>&nbsp;&nbsp;<?php echo $this->lblUserid; ?>:&nbsp;&nbsp; </td>
                <td><input type='text' name='userid'></td>
            </tr>
            <tr>
                <td> &nbsp;&nbsp;<?php echo $this->lblPassword;?>:&nbsp;&nbsp;&nbsp; </td>
                <td><input type='password' name='userpassword'></td>
            </tr>
            <tr>
                <td colspan='2' align='center'><input type='submit' name='btnLogOn' 
                    value='<?php echo $this->btnLogOn;?>'> 
         </form>
                </td>
                </tr>
                
            <form action ='forgotUseridOrPassword.php' method='post'>
            <tr>
                <td colspan='2' align='center'>
                
                <input type='submit'value="<?php echo $this->btnForgotPassword; ?>"> 
                </td>
            </tr>
            </form>

        </table>
        </body>
        </html>
        <?php
    }
    
    public function displayForgotPasswordUI()
    {
        
    ?>
        <form action="resetPassword.php" method='post'>
        <table border="1">
            <tr> <td colspan="2"><?php echo $this->lblInstructions; ?></td></tr>
            <tr> 
                <td>&nbsp;&nbsp;<?php echo $this->lblEmail; ?>:&nbsp;&nbsp; </td>
                <td><input type='text' name='email'></td>
            </tr>
            <tr>
                <td colspan='2' align='center'><input type='submit'  
            value="<?php echo $this->btnResetPassword;?>"> </form>
                </td>
                </tr>
            <form action ="index.php">
                <tr>
                    <td colspan='2' align='center'><input type='submit' 
                        value="<?php echo $this->btnBackToLogOn; ?>" > 
            </form>
                    </td>
                </tr>
        </table>
<?php        
    }
    
    public function displayLoggedOutUI()
    {?>
        You have logged out of the system
        <form action ='index.php' method='post'>
        <input type='submit' value='Return to Home'> </form>
<?php

    }
}
?>
