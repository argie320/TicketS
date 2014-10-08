
<form action="ticket-reply.php" method="post" enctype="multipart/form-data">

<!-- END OF ITEM DETAILS-->
                <Table style="margin-left:auto; margin-right:auto; margin-top:20px">
            		<tr>
                    	<th id="opentickets2">
                        Issue: The user will be able to see the issue summary below and any associated responses.
                        </th>
                       
                    </tr>
                </Table>
                <table id="table2" style="margin-top:15px">
                	<tr>
                    	<td>
                        	<label id="label" style="font-weight:bold">Subject: </label>
                            <label id="label">Issue summary.</label>
                        </td>
                        
                    </tr>
                    <tr>
                    	<td>
                        	<input id="issueinput" type="text" name="subject">
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label" style="font-weight:bold">
                            	Issue: 
                            </label>
                            <label id="label">Details on the reason(s) for opening the ticket.</label>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<textarea id="textarea" rows="10" cols="20" name="issue"></textarea>
                        </td>
                    </tr>
                </table><br>
                <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets2">
                        	Remarks: Optional remarks to the above issue.
                        </th>
                    </tr>
                </Table><br>
                <table id="table2">
                	<tr>
                    	<td>
                        	<label id="label" style="font-weight:bold;">Remarks:</label>
                        </td>
                        
                    </tr>
                    <tr>
                    	<td>
                        	<textarea id="textarea" rows="10" cols="20" name="remarks"></textarea>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        <label id="label"><p>Attachments:</label>
                        <input type="file" name="attachment[]" multiple>
                        </td>
                    </tr>
                </table>
                <table style="margin:auto; margin-top:15px;">
                    <tr>
                    	<td id="submit2">
                        	
                        		<input id="submit2" type="submit" name="reply" Value="Post Reply">
                            	<input id="submit2" type="submit" name="reset" Value="Reset">
                         </td>

                
                
                
                
                
                
               
            
                        </td>
                    </tr>
                </table>
                 <!-- START OF TICKET INFORMATION & OPTION!! -->
</form>
