<div class="modal fade in display_none" id="edit_employee_modal" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Töötaja redigeerimine</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group row m-t-25">
                    <div class="col-lg-3 text-lg-right">
                        <label for="edited-name" class="col-form-label">Täisnimi </label>
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
                        <label for="email" class="col-form-label">Email
                            </label>
                    </div>
                    <div class="col-xl-6 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope text-primary"></i></span>
                            <input type="text" placeholder=" " id="edited-email" name="edited-email"
                                   class="form-control"
                                   data-bv-field="email">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3 text-lg-right">
                        <label for="edited-position_id" class="col-form-label">Amet
                            </label>
                    </div>
                    <div class="col-xl-6 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-address-card text-primary"></i></span>
                            <select class="form-control" name="edited-position_id" id="edited-position_id"
                                    data-bv-for="position">
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3 text-lg-right">
                        <label for="edited-phone_number" class="col-form-label">Telefon
                            </label>
                    </div>
                    <div class="col-xl-6 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone text-primary"></i></span>
                            <input type="text" placeholder="58000000" id="edited-phone_number"
                                   name="edited-phone_number"
                                   class="form-control" data-bv-field="edited-phone_number">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3 text-lg-right">
                        <label for="edited-hire_date" class="col-form-label">Töölevõtukuupäev
                            </label>
                    </div>
                    <div class="col-xl-6 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar-o text-primary"></i></span>
                            <input type="text" name="edited-hire_date" id="edited-hire_date"
                                   class="form-control datepicker"
                                   data-bv-field="hire_date">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3 text-lg-right">
                        <label for="edited-password" class="col-form-label">Uus salasõna
                        </label>
                    </div>
                    <div class="col-xl-6 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock text-primary"></i></span>
                            <input type="password" name="edited-password" id="edited-password" class="form-control"
                                   data-bv-field="password">
                        </div>
                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="password"
                               data-bv-result="NOT_VALIDATED" style="display: none;">Enter the password
                        </small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Sulge</button>
                    <button type="button" id="edit_employee" class="btn btn-success">Salvesta</button>
                </div>
            </div>
        </div>
    </div>
</div>