<div class="modal" id="modal-confirm-danger" tabindex="-1" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal" href="#">×</a>
                <h3 class="page-title">
                Confirmation required
                </h3>
            </div>
            <div class="modal-body">
                <p class="cred lead js-confirm-text">You are going to transfer baidu2 / test to another owner. Are you ABSOLUTELY sure?</p>
                <p>
                <span class="js-warning-text">
                This action can lead to data loss.
                To prevent accidental actions we ask you to confirm your intention.
                </span>
                <br>
                Please type
                <code class="js-confirm-danger-match">{{ $phrase }}</code>
                to proceed or close this modal to cancel.
                </p>
                <div class="form-group">
                    <input type="text" name="confirm_name_input" id="confirm_name_input" value="" class="form-control js-confirm-danger-input">
                </div>
                <div class="form-actions">
                    <input type="submit" name="commit" value="Confirm" class="btn btn-danger js-confirm-danger-submit disabled" disabled="disabled">
                </div>
            </div>
        </div>
    </div>
</div>