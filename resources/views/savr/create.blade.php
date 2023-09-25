@extends('layouts.app')

@section('css')
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700" rel="stylesheet" />

    <link rel="stylesheet" href="{{ URL::asset('assets/test/css/style.css')}}" />
<style>
    .wizard>.content {
    max-height: 100% !important;
    background: #ffffff;
    display: block;
    /* margin: 0.5em; */
    min-height: 70vh;
    /* overflow: hidden; */
    position: inherit;
    width: auto;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}
</style>

@endsection


@section('content')
    <div class=" ">

        <div class="container">

            <div class="row c 2">

                <div class=" card col-md-12 p-3 ">
                    <div class=" ">
                        <h3 class="text-center p-2">QR SAVR</h3>
                        <form id="framework-wizard-form" action="#" style="display: none">
                            <h3></h3>
                            <fieldset class=" ">
                              <div class="row">
                                <div class="col-md-4"><label for="ba">Ba</label></div>
                                <div class="col-md-4"><input type="text" name="ba" id="ba" class="form-control" required></div>
                              </div>
                              <div class="row">
                                <div class="col-md-4"><label for="area">Area</label></div>
                                <div class="col-md-4"><input type="text" name="area" id="area" class="form-control" required></div>
                              </div>
                              <div class="row">
                                <div class="col-md-4"><label for="name_contractor">Contractor</label></div>
                                <div class="col-md-4"><input type="text" name="name_contractor" id="name_contractor" class="form-control" required></div>
                              </div>

                              <div class="row">
                                <div class="col-md-4"><label for="po_start-date">PO Start Date</label></div>
                                <div class="col-md-4"><input type="date" name="start-date" id="po_start-date" class="form-control" required></div>
                              </div>

                              <div class="row">
                                <div class="col-md-4"><label for="po_end_date">PO End Date</label></div>
                                <div class="col-md-4"><input type="date" name="end_date" id="po_end_date" class="form-control" required></div>
                              </div>

                              <div class="row">
                                <div class="col-md-4"><label for="fp_name">Name of Substation / Name of Feeder Pillar</label></div>
                                <div class="col-md-4"><input type="text" name="fp_name" id="fp_name" class="form-control" required></div>
                              </div>

                              <div class="row">
                                <div class="col-md-4"><label for="review_date">Review Date </label></div>
                                <div class="col-md-4"><input type="date" name="review_date" id="review_date" class="form-control" required></div>
                              </div>

                              <div class="row">
                                <div class="col-md-4"><label for="feeder_name">Feeder Name / Street Name</label></div>
                                <div class="col-md-4"><input type="text" name="feeder_name" id="feeder_name" class="form-control" required></div>
                              </div>

                              <div class="row">
                                <div class="col-md-4"><label for="">Section </label></div>

                              </div>

                              <div class="row">
                                <div class="col-md-4"><label for="section_from">From </label></div>
                                <div class="col-md-4"><input type="text" name="section_from" id="section_from" class="form-control" required></div>
                              </div>

                              <div class="row">
                                <div class="col-md-4"><label for="section_to">To</label></div>
                                <div class="col-md-4"><input type="date" name="section_to" id="section_to" class="form-control" required></div>
                              </div>

                            </fieldset>
                            <h3></h3>
                            <fieldset class="form-input">
                                <h3>Business Operations & Domain</h3>
                                <p>
                                    Geographical Considerations: In which countries/regions does
                                    the company operate, have a physical presence, or provide
                                    services to?
                                </p>
                                <input type="radio" id="country" name="country" value="USA" required />
                                <label for="USA">USA</label><br />
                                <input type="radio"id="country" name="country"value="UK/Europe" required />
                                <label for="UK/Europe">UK/Europe</label><br />
                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    @endsection

    @section('script')

    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="{{ URL::asset('assets/test/js/jquery.steps.js')}}"></script>


    <script>





        var form = $("#framework-wizard-form").show();
        form
            .steps({
                headerTag: "h3",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                onStepChanging: function(event, currentIndex, newIndex) {
                    // Allways allow previous action even if the current form is not valid!
                    if (currentIndex > newIndex) {
                        return true;
                    }

                    // Needed in some cases if the user went back (clean up)
                    if (currentIndex < newIndex) {
                        // To remove error styles
                        form.find(".body:eq(" + newIndex + ") label.error").remove();
                        form
                            .find(".body:eq(" + newIndex + ") .error")
                            .removeClass("error");
                    }
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                },

                onStepChanged: function(event, currentIndex, priorIndex) {
                    // Used to skip the "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                        form.steps("next");
                    }
                    // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3) {
                        form.steps("previous");
                    }
                },



                onFinished: function(event, currentIndex) {

                    var SelectedCountry = $("input[name='country']:checked").val();
                    var SelectedSector = $("input[name='sector']:checked").val();
                    var DataType = $("input[name='datatype']:checked").val();
                    var DataHandling = $("input[name='datahandling']:checked").val();
                    var DataTransfer = $("input[name='datatransfer']:checked").val();
                    var DataRetentionDeletion = $("input[name='dataretentiondeletion']:checked").val();
                    var CloudService = $("input[name='cloudservice']:checked").val();
                    var CriticalInfrastructure = $("input[name='criticalinfrastructure']:checked").val();
                    var ModifyOrExtendFramework = $("input[name='modifyorextendframework']:checked").val();
                    var Certification = $("input[name='certification']:checked").val();
                    var Obligations = $("input[name='obligations']:checked").val();

                    var law = '';
                    var acrossBorderLaw = '';
                    if (SelectedCountry == 'USA') {

                        if (SelectedSector == 'Finance') {
                            if (DataType == 'Personal Information') {
                                law = 'GLBA'
                            } else if (DataType == 'Financial Detail') {
                                law = 'PCI DSS'

                            }

                        } else if (SelectedSector == 'Health Care') {

                            if (DataType == 'Health Information') {
                                law = 'HIPAA'

                            } else if (DataType == 'Personal Information') {
                                law = 'CCPA'
                            }

                        } else if (SelectedSector == 'E-commerce') {
                            if (DataType == 'Personal Information') {
                                law = 'PCI DSS'

                            } else if (DataType == 'Financial Detail') {
                                law = 'CCPA'
                            }

                        }
                    }


                    if (SelectedCountry == 'UK/Europe') {

                        if (SelectedSector == 'Finance') {

                            if (DataType == 'Personal Information') {
                                law = 'GDPR'

                            } else if (DataType == 'Financial Detail') {
                              law = 'PRA / FCA'

                            }

                        } else if (SelectedSector == 'Health Care') {

                            if (DataType == 'Health Information') {
                                law = 'NHS Act 2006 / Care Act 2012 / the Data Protection Act, and the Human Rights Act'

                            } else if (DataType == 'Personal Information') {
                                law = 'GDPR'
                            }

                        } else if (SelectedSector == 'E-commerce') {
                            if (DataType == 'Personal Information') {
                                law = 'GDPR'

                            } else if (DataType == 'Financial Detail') {
                              law = 'PCI DSS'

                            }


                        }

                    }

                    if (DataTransfer == 'Yes' && SelectedCountry == 'USA') {

                      acrossBorderLaw = 'Dekh k batoun ga'

                    }else if(DataTransfer == 'Yes' && SelectedCountry == 'UK/Europe'){
                      var dataTranferBorder = $("input[name='transfercondition']:checked").val();

                      acrossBorderLaw = dataTranferBorder == 'uktousa' ? "Standard Contractual Clauses (SCCs)" : "GDPR"
                    }
                    console.log(law);
                    console.log(acrossBorderLaw);


                    // var count=[SelectedCountry,SelectedSector,DataHandling,DataTransfer,DataRetentionDeletion,CloudService]

                    //console.log(count)
                    // console.log(SelectedCountry);
                    // console.log(SelectedSector);
                    // console.log(DataHandling);
                    // console.log(DataTransfer);
                    // console.log(DataRetentionDeletion);
                    // console.log(CloudService);
                    // console.log(CriticalInfrastructure);
                    // console.log(ModifyOrExtendFramework);
                    // console.log(Certification);
                    // console.log(Obligations);



                    // alert(count);

                },
            })
    </script>
@endsection
