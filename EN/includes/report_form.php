<!-- modal report form -->
<div class='modal' id="report_form_modal">
    <!-- modal-header  -->
    <div class="modal-header">
        <span onclick="closeModal('report_form_modal');">X</span>
    </div>
    <!-- end of modal-header  -->
   <!-- modal-contents  -->
    <div class="modal-contents">
        <!-- modal-content  -->
        <div class="modal-content">
            <h4>Report</h4>
        </div>
        <!-- end of modal-content  -->
        <!-- modal-content  -->
        <div class="modal-content">
            <div class="report-form-header">
                <p>
                    We value your feedback!
                    <br>
                    We will review your report and take necessary actions.
                    <br>
                    However, we will not diclose the identity of the user who reports it. 
                </p>
            </div>
            <div class="report-form-input">
                <span id="SendersRemark" role="textbox" contenteditable onclick="this.innerHTML='';">Tell us why you are reporting this post or comment...</span>
                <input type="hidden" name="report-link" id="report-link">
            </div>
            <div class="report-form-button">
                <button type="button" onclick="processReport();">Submit</button>
            </div>
        </div>
        <!-- end of modal-content  -->
    </div>
    <!-- end of modal-contents -->
</div>