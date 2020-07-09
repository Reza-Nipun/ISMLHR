<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<table width="100%" height="100%"  cellpadding="0" bgcolor="#CCCCCC" cellspacing="0" style="padding: 20px 0px 5px 0px">
      <tr align="center">
         <td>
            <!-- Start Header 
            <table width="65%" cellpadding="0" cellspacing="0" style=" background-color:#025C64;color: #FFF; font-weight:bold;  padding: 16px 0px 16px 14px; font-family: Arial, 	 Verdana, sans-serif; "> -->
            
            <table width="65%" cellpadding="0" cellspacing="0">
               <tr>
                  <td style="background-color:#025C64; color:#FFF; padding: 14px 0px 14px 12px">
                     <span style="font-size: 25px;">HOURLY PRODUCTION TRACKING SYSTEM</span>
                  </td>
                  <td style="font-weight:normal;font-size: 11px;background-color:#025C64">
                     <span style="font-weight:bold;">Send Date</span>
                     <br><?php echo $date ; ?> 
                  </td>
               </tr>
            </table>
            <!-- End Header -->
            <!-- Start Ribbon -->
            <table cellpadding="0" cellspacing="0"  width="65%"  bgcolor="#202020">
               <!-- Start Ribbon -->
               <tr>
 <td width="65%" bgcolor="#068C99" style="font-family: Arial, Verdana, sans-serif; padding: 5px 5px 0px 5px; font-size: 12px; color:#FFFFFF;" >
                  <span style="text-transform: uppercase; font-size: 16px; font-weight: bold;"> Unit Wise PRODUCTION OUTPUT SUMMARY OF DATE: <?php echo $production_output_date; ?></span><br>
                  <br>
               </td>
            </tr>
               <tr>
                  <td bgcolor="#025C64" width="562" height="13">
                  </td>
               </tr>
            </table>
            <!-- End Ribbon -->
            <!-- Start Title  -->
            <table cellpadding="0" width="65%" cellspacing="0">
               <tr>
                  <td bgcolor="#FFFFFF" height="10" width="562"></td>
               </tr>
            </table>
           <table cellpadding="0" cellspacing="0"width="65%" style="padding: 0px 0px 0px 5px" bgcolor="#FFFFFF">
                  <tr>
                     <td>&nbsp;</td>
                     <td valign="top" style="font-family: Arial, Verdana, sans-serif; padding-left: 2px; line-height: 20px; color:#222222" >
                        <table align="center" border="1" width="90%" cellspacing="0" cellpadding="0" class="bottomBorder">
                           <tr style="font-size:14px">
                              <th bgcolor="#CCCCCC" scope="row">Sewing</th>
                              <th scope="row">Target</th>
                              <th bgcolor="#CCCCCC" scope="row">Output</th>
                              <th>Achievement</th>
                           </tr>
                           <tr align="center" style="font-size:14px">
                              <th bgcolor="#CCCCCC">ISML-01</th>
                              <th scope="row"><?php echo round($s_target_isml1, 2) ; ?></th>
                              <th bgcolor="#CCCCCC"><?php echo round($s_actual_isml1, 2) ; ?></th>
                              <td><?php if ($s_target_isml1 != 0) {echo floor(($s_actual_isml1*100)/$s_target_isml1) ; echo ' %';} else echo '-';?></td>
                           </tr>
                           <tr style="font-size:14px">
                              <th  bgcolor="#CCCCCC" scope="row">ISML-02</th>
							  <th scope="row"><?php echo round($s_target_isml2, 2); ?></th>
                              <th bgcolor="#CCCCCC" scope="row"><?php echo round($s_actual_isml2, 2); ?></th>
                         <th><?php if ($s_target_isml2 != 0) { echo round(($s_actual_isml2*100)/$s_target_isml2, 2) ; echo ' %'; } else echo '-';?></th>
                           </tr>
                           <tr bgcolor="#FFFFCC" align="center" style="font-size:15px">
                              <th scope="row" bgcolor="#FFFFCC">Total</th>
                              <th scope="row" bgcolor="#FFFFCC"><?php echo round($total_sweing_target, 2); ?></th>
                              <th scope="row" bgcolor="#FFFFCC"><?php echo round($total_sweing_actual, 2); ?></th>
                              <th bgcolor="#FFFFCC"><?php if ($total_sweing_target != 0) {echo round(($total_sweing_actual*100)/$total_sweing_target, 2) ; echo ' %'; } else echo '-';?></th>
                           </tr>
                        </table>
                        <table align="center" border="1" width="90%" cellspacing="0" cellpadding="0" class="bottomBorder">
                           <tr style="font-size:14px">
                              <th bgcolor="#CCCCCC" scope="row">Finishing</th>
                              <th scope="row">Target</th>
                              <th bgcolor="#CCCCCC" scope="row">Output</th>
                              <th>Achievement</th>
                           </tr>
                           <tr align="center" style="font-size:14px">
                              <th bgcolor="#CCCCCC">ISML-01</th>
								<th scope="row"><?php echo round($f_target_isml1, 2) ; ?></th>
								<th bgcolor="#CCCCCC"><?php echo round($f_actual_isml1, 2) ; ?></th>
                              <th><?php
                                 if ($f_target_isml1 != 0)
                                 { echo round(($f_actual_isml1*100)/$f_target_isml1, 2) ; echo ' %';}
                                 else echo '-';
                                 ?></th>
                           </tr>
                           <tr style="font-size:14px">
                              <th  bgcolor="#CCCCCC" scope="row">ISML-02</th>
                                <th scope="row"><?php echo round($f_target_isml2, 2); ?></th>
                                <th bgcolor="#CCCCCC" scope="row"><?php echo round($f_actual_isml2, 2); ?></th>
                              <th><?php
                                 if ($f_target_isml2 != 0)
                                 { echo round(($f_actual_isml2*100)/$f_target_isml2, 2) ; echo ' %';}
                                 else echo '-';
                                 ?></th>
                           </tr>
                           <tr bgcolor="#FFFFCC" align="center" style="font-size:15px">
                              <th scope="row" bgcolor="#FFFFCC">Total</th>
                              <th scope="row" bgcolor="#FFFFCC"><?php echo round($total_finishing_target, 2); ?></th>
                              <th scope="row" bgcolor="#FFFFCC"><?php echo round($total_finishing_actual, 2); ?></th>
                              <th bgcolor="#FFFFCC"><?php if ($total_finishing_target != 0) { echo round(($total_finishing_actual*100)/$total_finishing_target, 2) ; echo '%'; } else '-'; ?></th>
                           </tr>
                        </table>
             <span><a href="10.234.20.55/tracker" style="font-weight:bold; font-size:12px ;color:#000000; text-decoration:none;">Go Home page</a></span>
                     </td>
                     <td bgcolor="#FFFFFF" width="10" height="100"></td>
                  </tr>
               </table>
               <!-- End Product 2 -->
               <!-- Start Footer -->
               <table cellpadding="0" cellspacing="0" width="65%" height="76">
                  <tr>
                     <td height="5" bgcolor="#025C64">
                     </td>
                  </tr>
                  <tr>
                     <td height="64" bgcolor="#068C99" style="font-size: 11px; font-family: Arial, Verdana, sans-serif; color:#FFFFFF; padding-left: 15px; width:350px;">
                        <strong>This is system generated email. Please do not reply to this message. <br>
                        Copyright &copy; 2014  <a href="http://www.viyellatexgroup.com/" style="font-weight:bold; color:#FFFFFF;">VIYELLATEX</a> All rights reserved.
                        </strong>
                     </td>
                  </tr>
                  <tr>
                     <td height="5" bgcolor="#025C64">
                     </td>
                  </tr>
               </table>
               <!-- End Footer -->
               <td>
               <tr>
            </table></body>
</html>