<style type="text/css">
<!--
.test_run {
	color: #0F0;
	font-size: 18px;
}
-->
</style>
<body>
    <!-- Start Main Table -->
  <table width="100%" height="100%"  cellpadding="0" bgcolor="#CCCCCC" cellspacing="0" style="padding: 20px 0px 5px 0px">
        <tr align="center">
            <td>

                <table width="65%" cellpadding="0" cellspacing="0">
                   <tr>
                     <td style="background-color:#025C64; color:#FFF; padding: 14px 0px 14px 12px">
                         <span style="font-size: 28px;"><strong>ISML Daily Attendance Summary</strong>  (<span class="test_run">Test Run</span>)</span>
             </td>
                      
                      <td style="background-color:#025C64; color:#FFF; padding: 14px 0px 14px 12px">
                         <span style="font-size: 14px;"><strong>Mail Send Date:</strong>&nbsp;'.$today_display.'</span>
                      </td>
                   </tr>
                    <tr>
                       <td width="317" colspan="2" align="left" bgcolor="#068C99" style="font-weight:normal;font-size: 16px; color:#FFF;">
                       <p><span style="font-weight:bold;">&nbsp;&nbsp;&nbsp;Taken Today at '.$datex.' ('.$today_display.')</span></p></td>
                    </tr>
                   <tr>
                      <td colspan="2" bgcolor="#025C64" width="448" height="13"></td>
                   </tr>
                   <tr>
                      <td colspan="2" bgcolor="#FFFFFF" height="10" width="562">&nbsp;</td>
                   </tr>
            </table>
                <!-- End Header -->
                <!-- Start Ribbon -->
                
                <!-- End Ribbon -->
                <!--	Mail Body Data Table. Unit-1, Unit-2 and Summary Tables Inside in this Table	-->
                <table align="center" cellpadding="0" cellspacing="0"width="65%" style="padding: 0px 0px 0px 5px" bgcolor="#FFFFFF">
                    <tr>
                        <td valign="top" style="font-family: Arial, Verdana, sans-serif; padding-left: 5px; line-height: 10px; color:#222222" >

                            <br />
                            <table align="center" border="1" width="40%" cellspacing="0" cellpadding="0" class="bottomBorder" style="line-height: 20px">
                                <tr style="font-size:14px" bgcolor="#0099FF">
                                    <th width="18%" scope="row">Grand Total</th>
                                    <th width="16%" scope="row">Percentage</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">Total Present</th>
                                    <th scope="row">'.$total_present_percentage.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">Total Absent</th>
                                    <th scope="row">'.$total_absent_percentage.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">Total Leave</th>
                                    <th scope="row">'.$total_leave_percentage.'</th>
                                </tr>
                                <tr align="center" style="font-size:14px">
                                    <th>Total Strength</th>
                                    <th >'.$total_strength_percentage.'</th>
                                </tr>
                            </table>

                            <!--	Unit 1 Report	-->
                            <h2 style="color:#FFBC00" align="center">Unit 1</h2>
                            <table align="center" border="1" width="90%" cellspacing="0" cellpadding="0" class="bottomBorder" style="line-height: 20px">
                                <tr style="font-size:14px" bgcolor="#FFBC00">
                                    <th width="18%" scope="row">&nbsp;</th>
                                    <th width="15%" scope="row">Strength</th>
                                    <th width="16%" scope="row">Present</th>
                                    <th width="16%" scope="row">Attend %</th>
                                    <th width="16%" scope="row">Absent</th>
                                    <th width="16%" scope="row">Leave</th>
                                </tr>
                                <tr align="center" style="font-size:14px">
                                    <th>FW</th>
                                    <th scope="row">'.$FW1.'</th>
                                    <th >'.$present_FW1.'</th>
                                    <th >'.$attnd_unit1_FW.'</th>
                                    <th >'.$absent_FW1.'</th>
                                    <th >'.$LV_MLV_Unit1_FW.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">NMS</th>
                                    <th scope="row">'.$NMS1.'</th>
                                    <th scope="row">'.$present_NMS1.'</th>
                                    <th scope="row">'.$attnd_unit1_NMS.'</th>
                                    <th scope="row">'.$absent_NMS1.'</th>
                                    <th scope="row">'.$LV_MLV_Unit1_NMS.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">MS</th>
                                    <th scope="row">'.$MS1.'</th>
                                    <th scope="row">'.$present_MS1.'</th>
                                    <th scope="row">'.$attnd_unit1_MS.'</th>
                                    <th scope="row">'.$absent_MS1.'</th>
                                    <th scope="row">'.$LV_MLV_Unit1_MS.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">Total</th>
                                    <th scope="row">'.$strength_unit1.'</th>
                                    <th scope="row">'.$present_unit1.'</th>
                                    <th scope="row">'.$attnd_unit1_percentage.'</th>
                                    <th scope="row">'.$absent_unit1.'</th>
                                    <th scope="row">'.$LV_unit1.'</th>
                                </tr>
                            </table>

                            <!--	Unit-2 Report	-->

                            <h2 style="color:#FF5900" align="center">Unit 2</h2>
                            <table align="center" border="1" width="90%" cellspacing="0" cellpadding="0" class="bottomBorder" style="line-height: 20px">
                                <tr style="font-size:14px" bgcolor="#FF5900">
                                    <th width="18%" scope="row">&nbsp;</th>
                                    <th width="15%" scope="row">Strength</th>
                                    <th width="16%" scope="row">Present</th>
                                    <th width="16%" scope="row">Attend %</th>
                                    <th width="16%" scope="row">Absent</th>
                                    <th width="16%" scope="row">Leave</th>
                                </tr>
                                <tr align="center" style="font-size:14px">
                                    <th>FW</th>
                                    <th scope="row">'.$FW2.'</th>
                                    <th >'.$present_FW2.'</th>
                                    <th >'.$attnd_unit2_FW.'</th>
                                    <th >'.$absent_FW2.'</th>
                                    <th >'.$LV_MLV_Unit2_FW.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">NMS</th>
                                    <th scope="row">'.$NMS2.'</th>
                                    <th scope="row">'.$present_NMS2.'</th>
                                    <th scope="row">'.$attnd_unit2_NMS.'</th>
                                    <th scope="row">'.$absent_NMS2.'</th>
                                    <th scope="row">'.$LV_MLV_Unit2_NMS.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">MS</th>
                                    <th scope="row">'.$MS2.'</th>
                                    <th scope="row">'.$present_MS2.'</th>
                                    <th scope="row">'.$attnd_unit2_MS.'</th>
                                    <th scope="row">'.$absent_MS2.'</th>
                                    <th scope="row">'.$LV_MLV_Unit2_MS.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">Total</th>
                                    <th scope="row">'.$strength_unit2.'</th>
                                    <th scope="row">'.$present_unit2.'</th>
                                    <th scope="row">'.$attnd_unit2_percentage.'</th>
                                    <th scope="row">'.$absent_unit2.'</th>
                                    <th scope="row">'.$LV_unit2.'</th>
                                </tr>
                            </table>
					<p style="color:#0066CC" align="center">&nbsp;</p>
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
    </table>
    <!-- End Main Table -->
</body>