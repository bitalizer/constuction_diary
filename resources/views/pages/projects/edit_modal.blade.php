<div class="modal fade in display_none" id="edit_object_modal" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Objekti redigeerimine</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group row m-t-25">
                    <div class="col-lg-3 text-lg-right">
                        <label for="edited-name" class="col-form-label">Nimetus </label>
                    </div>
                    <div class="col-xl-6 col-lg-8">
                        <div class="input-group">
                                    <span class="input-group-addon"> <i class="fa fa-user text-primary"></i>
                                    </span>
                            <input type="text" name="edited-name" id="edited-name" class="form-control"
                                   data-bv-field="name">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3 text-lg-right">
                        <label for="location" class="col-form-label">Asukoht
                        </label>
                    </div>
                    <div class="col-xl-6 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker text-primary"></i></span>
                            <input type="text" name="edited-location" id="edited-location"
                                   class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Sulge</button>
                    <button type="button" id="edit_object" class="btn btn-success">Salvesta</button>
                </div>
            </div>
        </div>
    </div>
</div>