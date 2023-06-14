<div class="modal fade in display_none" id="responsive" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Töötaja lisamine</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <form id="add_worker_form" class="form-horizontal">
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-lg-10 push-lg-1">
                                        <label for="worker_select" class="col-form-label form-group-horizontal">
                                            Töötaja *
                                        </label>
                                        <div class="input-group">
                                            <select size="3" multiple class="form-control chzn-select"
                                                    id="worker_select"
                                                    name="worker_select" tabindex="8">
                                                @foreach($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-10 push-lg-1">
                                        <label for="signup_email" class="col-form-label form-group-horizontal">
                                            Töö algus *
                                        </label>
                                        <div class="input-group input-append date"
                                             data-date-format="dd-mm-yyyy">
                                                 <span class="input-group-addon add-on">
                                                    <i class="fa fa-hourglass-start"></i>
                                                </span>
                                            <input class="form-control clockpicker" id="start_time" type="text"
                                                   readonly="true" placeholder="tt:mm">

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-10 push-lg-1">
                                        <label for="signup_email" class="col-form-label form-group-horizontal">
                                            Töö lõpp *
                                        </label>
                                        <div class="input-group input-append date"
                                             data-date-format="dd-mm-yyyy">
                                                 <span class="input-group-addon add-on">
                                                    <i class="fa fa-hourglass-end"></i>
                                                </span>
                                            <input class="form-control clockpicker" id="end_time" type="text"
                                                   readonly="true" placeholder="tt:mm">

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-10 push-lg-1">
                                        <label for="signup_email" class="col-form-label form-group-horizontal">
                                            Tunnid *
                                        </label>
                                        <div class="input-group input-append date"
                                             data-date-format="dd-mm-yyyy">
                                                 <span class="input-group-addon add-on">
                                                    <i class="fa fa-clock-o"></i>
                                                </span>
                                            <input class="form-control" type="number" id="hours" placeholder="0.0" min="0" max="24" step="0.5" pattern="^\d+(?:\.\d{1,1})?$">

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-10 push-lg-1">
                                        <label for="signup_email" class="col-form-label form-group-horizontal">
                                            Märge
                                        </label>
                                        <div class="input-group input-append">
                                                 <span class="input-group-addon add-on">
                                                    <i class="fa fa-sticky-note-o"></i>
                                                </span>
                                            <input id="note" class="form-control" type="text"
                                                   placeholder="Vajadusel sisestage märge">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Sulge</button>
                <button type="button" id="add_new_worker" class="btn btn-success">Lisa</button>
            </div>
        </div>
    </div>
</div>