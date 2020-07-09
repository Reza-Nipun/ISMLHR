<body>

<table width="100%" height="100%"  cellpadding="0" bgcolor="#CCCCCC" cellspacing="0" style="padding: 20px 0px 5px 0px">
      <tr align="center">
         <td>
		     <table width="65%" cellpadding="0" cellspacing="0">
                   <tr>
                     <td style="background-color:#025C64; color:#FFF; padding: 14px 0px 14px 12px">
                         <span style="font-size: 25px;">ISML Production Summary Report</span>
                      </td>
                      
                      <td style="background-color:#025C64; color:#FFF; padding: 14px 0px 14px 12px">
                         <span style="font-size: 14px;"><strong>Mail Send Date:</strong>&nbsp;'.$today.'</span>
                      </td>
                   </tr>
                    <tr>
                       <td width="317" colspan="2" align="left" bgcolor="#068C99" style="font-weight:normal;font-size: 16px; color:#FFF;">
                       <p><span style="font-weight:bold;">&nbsp;&nbsp;&nbsp;Report Date &#8594;</span>'.$report_send_date.'</p></td>
                    </tr>
                   <tr>
                      <td colspan="2" bgcolor="#025C64" width="448" height="13"></td>
                   </tr>
                   <tr>
                      <td colspan="2" bgcolor="#FFFFFF" height="10" width="562">&nbsp;</td>
                   </tr>
            </table>
                            			
            <!-- End Ribbon -->
            <!-- Start Title  -->
            <!-- <table cellpadding="0" width="65%" cellspacing="0">
               <tr>
                  <td bgcolor="#FFFFFF" height="10" width="562"></td>
               </tr>
            </table>  -->
           <table cellpadding="0" cellspacing="0" width="65%" style="padding: 0px 0px 0px 5px" bgcolor="#FFFFFF">
                  <tr>
                    <td>&nbsp;</td>
                    <td valign="top" style="font-family: Arial, Verdana, sans-serif; padding-left: 2px; line-height: 20px; color:#222222" >
					<h2 align="center" style="color:#FF5900">Cutting Summary</h2>
                        <table align="center" border="1" width="90%" cellspacing="0" cellpadding="0" class="bottomBorder">
                           <tr style="font-size:14px">
                              <th bgcolor="#FF5900" scope="row">Cutting</th>
                              <th scope="row">Target</th>
                              <th bgcolor="#CCCCCC" scope="row">Output</th>
                              <th>Achievement</th>
							  <th>Comments</th>
                           </tr>
                           <tr align="center" style="font-size:14px">
                              <th bgcolor="#CCCCCC">ISML-01</th>
                              <th scope="row">'.$c_target_isml1.'</th>
                              <th bgcolor="#CCCCCC">'.$c_actual_isml1.'</th>
                              <th>'.$c_achievement_isml1.' %</th>
							  <th style="font-size:11px">'.$cutting_comments_isml1.'</th>
                           </tr>
                           <tr style="font-size:14px">
                              <th  bgcolor="#CCCCCC" scope="row">ISML-02</th>
							  <th scope="row">'.$c_target_isml2.'</th>
                              <th bgcolor="#CCCCCC" scope="row">'.$c_actual_isml2.'</th>
                        	  <th>'.$c_achievement_isml2.' %</th>
							  <th style="font-size:11px">'.$cutting_comments_isml2.'</th>
                           </tr>
                           <tr bgcolor="#FFFFCC" align="center" style="font-size:15px">
                              <th scope="row" bgcolor="#FFFFCC">Total</th>
                              <th scope="row" bgcolor="#FFFFCC">'.$total_cutting_target.'</th>
                              <th scope="row" bgcolor="#FFFFCC">'.$total_cutting_actual.'</th>
                              <th bgcolor="#FFFFCC">'.$total_cutting_achievement.' %</th>
							  <th bgcolor="#FFFFCC">&nbsp;</th>
                           </tr>
                        </table>
                    <h2 align="center" style="color:#030" >Sewing Summary</h2>
						<table align="center" border="1" width="90%" cellspacing="0" cellpadding="0" class="bottomBorder">
                           <tr style="font-size:14px">
                              <th bgcolor="#00FF00" scope="row">Sewing</th>
                              <th scope="row">Target</th>
                              <th bgcolor="#CCCCCC" scope="row">Output</th>
                              <th>Achievement</th>
							  <th>Comments</th>
                           </tr>
                           <tr align="center" style="font-size:14px">
                              <th bgcolor="#CCCCCC">ISML-01</th>
                              <th scope="row">'.$s_target_isml1.'</th>
                              <th bgcolor="#CCCCCC">'.$s_actual_isml1.'</th>
                              <th>'.$s_achievement_isml1.' %</th>
							  <th style="font-size:11px">'.$sewing_comments_isml1.'</th>
                           </tr>
                           <tr style="font-size:14px">
                              <th  bgcolor="#CCCCCC" scope="row">ISML-02</th>
							  <th scope="row">'.$s_target_isml2.'</th>
                              <th bgcolor="#CCCCCC" scope="row">'.$s_actual_isml2.'</th>
                        	  <th>'.$s_achievement_isml2.' %</th>
							  <th style="font-size:11px">'.$sewing_comments_isml2.'</th>
                           </tr>
                           <tr bgcolor="#FFFFCC" align="center" style="font-size:15px">
                              <th scope="row" bgcolor="#FFFFCC">Total</th>
                              <th scope="row" bgcolor="#FFFFCC">'.$total_sweing_target.'</th>
                              <th scope="row" bgcolor="#FFFFCC">'.$total_sweing_actual.'</th>
                              <th bgcolor="#FFFFCC">'.$total_sweing_achievement.' %</th>
							  <th bgcolor="#FFFFCC">&nbsp;</th>
                           </tr>
                        </table>
					<h2 style="color:#0066CC" align="center">Finishing Summary</h2>
						<table align="center" border="1" width="90%" cellspacing="0" cellpadding="0" class="bottomBorder">
  <tr style="font-size:14px">
    <th width="15%" bgcolor="#0066CC" scope="row">Finishing</th>
    <th width="12%" scope="row">Target</th>
    <th width="12%" bgcolor="#CCCCCC" scope="row">Output</th>
    <th width="18%">Achievement</th>
    <th width="43%">Comments</th>
  </tr>
  <tr align="center" style="font-size:14px">
    <th bgcolor="#CCCCCC">ISML-01</th>
    <th scope="row">'.$f_target_isml1.'</th>
    <th bgcolor="#CCCCCC">'.$f_actual_isml1.'</th>
    <th>'.$f_achievement_isml1.' %</th>
    <th width="45%" style="font-size:11px">'.$finishing_comments_isml1.'</th>
  </tr>
  <tr style="font-size:14px">
    <th  bgcolor="#CCCCCC" scope="row">ISML-02</th>
    <th scope="row">'.$f_target_isml2.'</th>
    <th bgcolor="#CCCCCC" scope="row">'.$f_actual_isml2.'</th>
    <th>'.$f_achievement_isml2.' %</th>
    <th width="45%" style="font-size:11px">'.$finishing_comments_isml2.'</th>
  </tr>
  <tr bgcolor="#FFFFCC" align="center" style="font-size:15px">
    <th scope="row" bgcolor="#FFFFCC">Total</th>
    <th scope="row" bgcolor="#FFFFCC">'.$total_finishing_target.'</th>
    <th scope="row" bgcolor="#FFFFCC">'.$total_finishing_actual.'</th>
    <th bgcolor="#FFFFCC">'.$total_finishing_achievement.' %</th>
    <th width="45%" bgcolor="#FFFFCC">&nbsp;</th>
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
</table></body>