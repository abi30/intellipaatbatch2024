@extends('layout')

@section('title', 'Kündigungen durch Kunden')

@section('content')

@php
$contractId = $id;
$employee = $sessionData['employee'] ?? '';
$shareTemplate = $sessionData['getrightsvonapi']['user']['rights']['VN_VU']['shareTemplate'];
// $shareTemplate = true;
$useTemplate = $sessionData['getrightsvonapi']['user']['rights']['VN_VU']['useTemplate'];
$createTemplate = $sessionData['getrightsvonapi']['user']['rights']['VN_VU']['createTemplate'];


@endphp

<div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Kündigungs-Assistent</h2>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#0">Assistent</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Kündigungen durch Kunden
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <!-- ========== form-elements-wrapper start ========== -->
    <div class="form-elements-wrapper">


        {{-- ==========templates start=================== --}}




        <div id="category_1" class="card-style mb-30">
            <h4 class="card-title">Kündigungen durch Kunden</h4>

            {{-- <button id="new_template_create" class="main-btn primary-btn btn-hover">
                  Update Profile
                </button> --}}

            <div id="formCards" class="row">

            </div>
        </div>
        {{-- ============templates end================= --}}


        {{-- -------Modal start------- --}}

        <div class="modal fade modal-fullscreen" id="staticBackdrop" data-bs-backdrop="static" role="dialog"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content" style=" background-color: transparent;">
                    <div class="modal-header p-0 border-0">
                        <h1 class="modal-title fs-4" id="exampleModalFullscreenLabel"></h1>
                        <button id="closeButton" type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">schließen</button>
                    </div>
                    <div class="modal-body">


                        {{-- ======main row start ===== --}}
                        {{-- style="background-color: #E0E5EC;    #E9ECEF " --}}
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="card-style mb-30 card">
                                    <h5 class="card-title">Brief-Editor</h5>
                                    <div class="card-body">

                                        <form id="formcreating">
                                            @csrf
                                            <input type="hidden" id="template_id" name="template_id">
                                            <input type="hidden" id="template_owner_id" name="template_owner_id">


                                            <div class="mb-3 row">
                                                <div id="buttonsdiv" class="col-sm-2">
                                                    <label for="editor" class="col-form-label">Briefinhalt</label>
                                                    @php
                                                    $policyNumber =
                                                    $sessionData['onlyOneContract']['Versicherungsscheinnummer'] ?? '';
                                                    $sparte = $sessionData['onlyOneContract']['Sparte'] ?? '';
                                                    $gesellschaft = $sessionData['onlyOneContract']['Gesellschaft'] ??
                                                    '';

                                                    $beginnDatum = $sessionData['onlyOneContract']['BeginnDatum'] !==
                                                    null ? $sessionData['onlyOneContract']['BeginnDatum'] : 'nicht
                                                    vorhand';
                                                    $ablaufDatum = $sessionData['onlyOneContract']['AblaufDatum'] !==
                                                    null ? $sessionData['onlyOneContract']['AblaufDatum'] : 'nicht
                                                    vorhand';

                                                    if($beginnDatum!=='nicht vorhand'){
                                                    $beginnDatum = date("d.m.Y", strtotime($beginnDatum));
                                                    }
                                                    if($ablaufDatum!=='nicht vorhand'){
                                                    $ablaufDatum = date("d.m.Y", strtotime($ablaufDatum));
                                                    }




                                                    @endphp


                                                    @php
                                                    $nameOfCustomer = '';
                                                    $geburts_oder_gruendungs_datum = '';
                                                    $ansprechpartner = '';
                                                    $ansprechpartnerBtnName = '';
                                                    $customerBtnName = '';
                                                    $datumBtnName = '';
                                                    $customerOrCompany =
                                                    $sessionData['kundeUndVermittler']['kunde']->kunden;

                                                    $typeOfCustomer = $customerOrCompany['Person']['Typ'] ===
                                                    'natuerlich' ? 'natuerlich' : 'juristisch';

                                                    if ($typeOfCustomer === 'natuerlich') {
                                                    $titel = $customerOrCompany['Person']['Titel'] ?? '';
                                                    $vorname = $customerOrCompany['Person']['Vorname'] ?? '';
                                                    $nachname = $customerOrCompany['Person']['Nachname'] ?? '';
                                                    $geburtsdatum = $customerOrCompany['Person']['Geburtsdatum'] !==
                                                    null ? $customerOrCompany['Person']['Geburtsdatum'] : 'nicht
                                                    vorhand';

                                                    $nameOfCustomer = $titel . ' ' . $vorname . ' ' . $nachname;
                                                    $geburts_oder_gruendungs_datum = date("d.m.Y",
                                                    strtotime($geburtsdatum));

                                                    // dd($geburts_oder_gruendungs_datum,"test1");
                                                    $customerBtnName = 'Kundenname';
                                                    $datumBtnName = 'geburtsdatum';
                                                    } elseif ($typeOfCustomer === 'juristisch') {
                                                    $firma = $customerOrCompany['Person']['Firma'] ?? '';
                                                    $gruendungsdatum = $customerOrCompany['Person']['Gruendungsdatum']
                                                    !== null ? $customerOrCompany['Person']['Gruendungsdatum'] : 'nicht
                                                    vorhand';

                                                    $nameOfCustomer = $firma;
                                                    $geburts_oder_gruendungs_datum = date("d.m.Y",
                                                    strtotime($gruendungsdatum));
                                                    // dd($geburts_oder_gruendungs_datum,"test2");

                                                    $ansprechpartner = $customerOrCompany['Person']['Ansprechpartner']
                                                    !== null ? $customerOrCompany['Person']['Ansprechpartner'] : 'nicht
                                                    vorhand';

                                                    $customerBtnName = 'Firmenname';
                                                    $datumBtnName = 'gruendungsdatum';
                                                    $ansprechpartnerBtnName = 'Ansprechpartner';
                                                    } else {
                                                    $nameOfCustomer = 'empty name';
                                                    $geburts_oder_gruendungs_datum = 'empty datum';

                                                    $customerBtnName = 'empty Kundenname';
                                                    $datumBtnName = 'empty geburtsdatum';
                                                    }

                                                    @endphp


                                                    <button id="nameOfCustomerButton" type="button"
                                                        class="custom-btn btn-18  mt-40 mb-1 btn-sm"><span>{{ $customerBtnName }}</span></button>
                                                    <button id="geburtsdatumButton" type="button"
                                                        class="custom-btn btn-18  mb-1 btn-sm"><span>{{ $datumBtnName }}</span></button>
                                                    @if ($typeOfCustomer === 'juristisch')
                                                    <button id="ansprechpartnerButton" type="button"
                                                        class="custom-btn btn-18  mb-1 btn-sm"><span>{{ $ansprechpartnerBtnName }}</span></button>
                                                    @endif
                                                    {{-- btnInhalt_1 --}}


                                                    <button id="polizzeButton" type="button"
                                                        class="custom-btn btn-3 mb-1 mt-10  btn-sm"><span>Polizzennummer</span></button>
                                                    <button id="sparteButton" type="button"
                                                        class="custom-btn btn-3 mb-1 btn-sm"><span> Sparte
                                                        </span></button>
                                                    <button id="begindatumButton" type="button"
                                                        class="custom-btn btn-3 mb-1 btn-sm"><span>Begindatum</span></button>
                                                    {{-- btnInhalt_2 --}}

                                                    <button id="cancellationButton" type="button"
                                                        class="custom-btn btn-17 btn mt-10 mb-1  btn-sm"><span>Kündigungsdatum</span></button>
                                                    <button id="cancellationtypeButton" type="button"
                                                        class="custom-btn btn-17 btn mb-1  btn-sm"><span>Kündigungstyp</span></button>
                                                    {{-- btnInhalt_4 btn --}}






                                                </div>

                                                <div class="col-sm-10">
                                                    <div id="editor">
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="mb-3 row">
                                                <label for="form_templateSubject"
                                                    class="col-sm-2 col-form-label">Betreffzeile</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="form_templateSubject"
                                                        name="form_templateSubject" placeholder="Betreff">
                                                </div>
                                                <div class="col-sm-2"></div>
                                                <div id="betreffInput" class="col-sm-10 mt-1" style="display: none;">
                                                    <span>Platzhalter: </span>
                                                    <button id="betreffSparteButton" type="button"
                                                        class="custom-btn btn-3 btn  mb-1 btn-sm"><span>Sparte</span></button>
                                                    <button id="betreffPolizzeButton" type="button"
                                                        class="custom-btn btn-3 btn mb-1 btn-sm"><span>Polizze
                                                            Nr.</span></button>
                                                    {{-- btnInhalt_3 --}}
                                                </div>


                                            </div>


                                            <input type="hidden" id="hidden_form_templateSubject"
                                                name="hidden_form_templateSubject">


                                            <div class="mb-3 row">
                                                <label for="form_templateName"
                                                    class="col-sm-2 col-form-label">Kündigungsdatum</label>
                                                <div id="kuendigungsdatei" class="col-sm-10">
                                                    <div
                                                        class="form-check radio-style radio-warning mb-20 form-check-inline">
                                                        <input class="form-check-input kuendigungsclass" type="radio"
                                                            id="radioCurrentDate" name="dateOption" value="current">
                                                        <label class="form-check-label labelkuendigungs"
                                                            for="radioCurrentDate">&nbsp;Sofort</label>
                                                    </div>
                                                    <div
                                                        class="form-check radio-style radio-success mb-20 form-check-inline">
                                                        <input class="form-check-input kuendigungsclass" type="radio"
                                                            id="radioWantedDate" name="dateOption" value="wanted">
                                                        <label class="form-check-label labelkuendigungs"
                                                            for="radioWantedDate">&nbsp;Wunschdatum</label>
                                                    </div>

                                                    <div class="form-check radio-style  mb-20 form-check-inline">
                                                        <input class="form-control" type="text" id="dateInput"
                                                            name="dateInput" placeholder="datum">
                                                    </div>

                                                    <div id="calender_container" style="display: none;">
                                                        <div id="calendar" style="display:none;"></div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="form_templateName"
                                                    class="col-sm-2 col-form-label">Kündigungstyp</label>
                                                <div id="selectionId" class="col-sm-10">
                                                    <select id="kuendigungstyp" class="form-select"
                                                        aria-label="select example">
                                                        <option value="auswahl" selected>Typ auswählen ...</option>
                                                        @if (count($sessionData['getCancellationReasons']) > 0)
                                                        @foreach ($sessionData['getCancellationReasons'] as $option)
                                                        <option value="{{ htmlspecialchars($option['reasonText']) }}">
                                                            {{ htmlspecialchars($option['reasonName']) }}
                                                        </option>
                                                        @endforeach
                                                        @else
                                                        <option value="keine" disabled>Kein Typ vorhanden !</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="form_templateName"
                                                    class="col-sm-2 col-form-label">Vorlagenname</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="form_templateName"
                                                        name="form_templateName" placeholder="name">
                                                </div>
                                            </div>

                                            {{-- <div class="mb-3 row">
                                        <label for="form_templateName" class="col-sm-2 col-form-label">Cancellation reason</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="form_templateName"
                                                name="form_templateName" placeholder="name">
                                        </div>
                                    </div> --}}


                                            <div class="mb-3 row">
                                                <div class="col-sm-2 col-form-label"></div>
                                                <div class="col-sm-10" style="display:flex; justify-content: flex-end;">
                                                    <div
                                                        class="form-check form-switch toggle-switch form-check-reverse">
                                                        <label class="form-check-label" for="form_userOnly">Für Alle
                                                            freigeben</label>
                                                        <input class="form-control form-check-input" type="checkbox"
                                                            id="form_userOnly" name="form_userOnly" value="">
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="mb-3 row">
                                                <div class="col-sm-2 col-form-label"></div>
                                                <div id="saveupdatepreview"
                                                    class="col-lg-7 d-grid gap-2 d-md-flex justify-content-md-end">
                                                    <button id="saveButton" name="save" type="button"
                                                        class="save-custom-btn btn mb-2 btn-sm"
                                                        style="display: none;">Als Vorlage Speichern</button>
                                                    {{-- save-custom-btn btn --}}

                                                    <button id="updateButton" name="update" type="button"
                                                        class="btn update-custom-btn mb-2 btn-sm"
                                                        style="display: none;">Vorlage Speichern</button>

                                                    <button id="previewButton" name="preview" type="button"
                                                        class="btn preview-custom-btn mb-2 btn-sm"
                                                        style="display: none;">Brief-Vorschau</button>
                                                    {{-- btn preview-custom-btn --}}

                                                    <button id="archiveButton" name="archive" type="button"
                                                        class="btn archive-custom-btn mb-2 btn-sm"
                                                        style="display: none;">Brief Hinterlegen</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            {{-- <div class="col-lg-4">

                            <div class="card-style mb-30">
                              <div id="testcode1"></div>
                             </div> 
                            <div class="card-style mb-30">
                              <div id="testcode2"></div>
                             </div> 

                            <div class="card-style mb-30">
                                <div id="testcode3"></div>
                            </div>

                            <div class="card-style mb-30">
                                <div id="testcode6">
                                    @php
                                        dump($sessionData);
                                    @endphp
                                </div>
                            </div>

                        </div> --}}


                        </div>
                        {{-- ======main row end ===== --}}

                    </div>
                    {{-- <div class="modal-footer">
                    <button id="closeButton" type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                </div> --}}
                </div>
            </div>
        </div>

        {{-- -------Modal end------- --}}







        <script>
        $(document).ready(function() {


            const previewButton = $("#previewButton");
            const updateButton = $("#updateButton");
            const saveButton = $("#saveButton");
            const archiveButton = $("#archiveButton");
            const templateType = "VN_VU"; //template_type

            //  ===vertrag id ===
            const vertragId = "{{ $contractId }}";
            const employee = "{{ $employee }}";
            const shareTemplate = "{{ $shareTemplate }}";
            const formDataForAlltemplates = {
                id: vertragId
            };

            const createTemplate = @json($createTemplate);
            // const lengthCancellationType = "0";
            const lengthCancellationType = "{{ count($sessionData['getCancellationReasons']) }}";


            //  ===form value ===
            const template_id = $('#template_id');
            const template_owner_id = $('#template_owner_id');
            const form_userOnly = $("#form_userOnly");
            const form_templateName = $('#form_templateName');
            const form_templateSubject = $('#form_templateSubject');
            const form_templateCancellationDate = $('#dateInput');
            const form_templateCancellationTye = $('#kuendigungstyp');


            //  ===form value ===
            // ===========form betreff buttons ====================
            const cancellationtype_button = $('#cancellationtypeButton');
            let cancellationtype_button_clicked = false;

            const cancellation_button = $('#cancellationButton');
            let cancellation_button_clicked = false;

            const betreff_sparte_button = $('#betreffSparteButton');
            let betreff_sparte_button_clicked = false;

            const betreff_polizze_button = $('#betreffPolizzeButton');
            let betreff_polizze_button_clicked = false;

            // =================placeholder2 ===========================

            const placeHolder_1 = '[KUENDIGUNGSDATUM]';
            const placeHolder_2 = '[KUENDIGUNGSTYP]';



            // Enable or disable the button based on the initial input value
            // cancellation_button.prop('disabled', form_templateSubject.val().includes('[KUENDIGUNGSDATUM]'));
            // betreff_sparte_button.prop('disabled', form_templateSubject.val().includes('[BETREFF_SPARTE]'));
            // betreff_polizze_button.prop('disabled', form_templateSubject.val().includes('[BETREFF_PolNr.]'));
            // ===============================

            // ==============kuendigungsDatum erstellung here=================
            // ==============kuendigungsDatum erstellung here=================
            // ==============kuendigungsDatum erstellung here=================

            let datePickerInstance;

            function initializeDatePicker() {

                if (datePickerInstance) {
                    // If the datepicker instance exists, destroy it to reset it
                    $('#calendar').datepicker('destroy');
                }
                datePickerInstance = $('#calendar').datepicker($.extend({}, $.datepicker.regional['de'], {
                    inline: true,
                    firstDay: 1,
                    showOtherMonths: true,
                    monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli',
                        'August', 'September', 'Oktober', 'November', 'Dezember'
                    ],
                    monthNamesShort: ['Jan', 'Feb', 'Mär', 'Apr.', 'Mai', 'Jun', 'Jul', 'Aug',
                        'Sep', 'Okt', 'Nov', 'Dez'
                    ],
                    dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
                    minDate: 1, // Restricts selection of previous dates
                    dateFormat: 'dd.mm.yy', // Set the desired date format
                    onSelect: function(dateText, inst) {
                        $('#dateInput').val(
                            dateText); // Set the selected date in the input field
                        $('#calendar').hide();
                        $('#calender_container').hide();
                    },
                    onClose: function() {
                        $(this).datepicker('setDate', null);
                    }
                    // beforeShowDay: function(date) {
                    //     // Disable Saturdays and Sundays (0: Sunday, 6: Saturday)
                    //     return [(date.getDay() !== 0 && date.getDay() !== 6), ''];
                    // }
                }));
            }



            $('input[name="dateOption"]').change(function() {
                var selectedOption = $(this).val();

                if (selectedOption === "current" && $(this).is(':checked')) {
                    $('#calendar').hide();
                    $('#calender_container').hide();
                    var currentDate = getCurrentDate();
                    $('#dateInput').val(currentDate);
                } else if (selectedOption === "wanted" && $(this).is(':checked')) {
                    initializeDatePicker();
                    $('#calendar').show();
                    $('#calender_container').show();
                } else {
                    $('#calender_container').hide();
                }
            });



            // ==============kuendigungsDatum erstellung end=================
            // ==============kuendigungsDatum erstellung end=================
            // ==============kuendigungsDatum erstellung end=================




            // ============creating btns for Brief Erstellung quill js editor start ================                              
            // ============creating btns for Brief Erstellung quill js editor start ================                              
            // ============creating btns for Brief Erstellung quill js editor start ================                              
            // ============creating btns for Brief Erstellung quill js editor start ================                              

            const Embed = Quill.import('blots/embed');
            const Delta = Quill.import('delta');



            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                // ['blockquote', 'code-block'],
                [{
                    'header': 1
                }, {
                    'header': 2
                }], // custom button values
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }], // superscript/subscript
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }], // outdent/indent
                [{
                    'direction': 'rtl'
                }], // text direction
                // [{'size': ['small', false, 'large', 'huge']}], // custom dropdown
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                // [{'color': []}, {'background': []}], // dropdown with defaults from theme
                // [{'font': []}],
                // [{'align': []}],
                // ['clean'] // remove formatting button
            ];

            let quill = new Quill('#editor', {
                modules: {
                    toolbar: toolbarOptions,
                },
                placeholder: "Eingaben hier ....",
                theme: 'snow',
                readOnly: true,
            });



            previewButton.prop('disabled', true);
            form_userOnly.prop('disabled', true);
            form_templateName.prop('disabled', true);
            form_templateSubject.prop('disabled', true);

            // ============Brief Erstellung quill js editor end ================
            // ============Brief Erstellung quill js editor end ================
            // ============Brief Erstellung quill js editor end ================
            // ============Brief Erstellung quill js editor end ================


            // ============setInterVal functions and loadFormCards functions are here================




            // Your function to set the HTML content
            function updateHTMLContentOrigin(text) {
                $("#testcode1").text(text);
            }

            function updateHTMLContent(text) {
                $("#testcode2").text(text);
            }

            setInterval(() => {
                // const newText = $(".ql-editor").html();
                const newTextOriginQuilll = $(".ql-editor").html();
                let newText = modifyParagraphs(newTextOriginQuilll, placeHolder_1);
                newText = modifyParagraphs(newText, placeHolder_2);

                updateHTMLContentOrigin(newTextOriginQuilll);

                updateHTMLContent(newText);
            }, 50);


            function modifyParagraphs(htmlContent, placeholder) {

                if (!htmlContent.includes(placeholder)) {
                    return htmlContent;
                }

                let modifiedHtmlContent = '';

                // Create a jQuery object to work with the provided HTML content
                const $html = $('<div>').html(htmlContent);

                // Process each <p> element
                $html.find('p').each(function() {
                    const text = $(this).text().trim();
                    const brTag = '<br>';

                    const startIndex = text.indexOf(placeholder);
                    const endIndex = text.lastIndexOf(placeholder);

                    if (startIndex >= 0 && endIndex >= 0) {
                        // Placeholder appears in the middle of the text
                        const prefix = text.substring(0, startIndex);
                        const suffix = text.substring(endIndex + placeholder.length);
                        const modifiedText = `${prefix}${brTag}${placeholder}${brTag}${suffix}`;
                        $(this).html(modifiedText);
                    } else if (startIndex === 0) {
                        // Placeholder appears at the beginning of the text
                        const suffix = text.substring(placeholder.length);
                        const modifiedText = `${placeholder}${brTag}${suffix}`;
                        $(this).html(modifiedText);
                    } else if (endIndex === text.length - placeholder.length) {
                        // Placeholder appears at the end of the text
                        const prefix = text.substring(0, endIndex);
                        const modifiedText = `${prefix}${brTag}${placeholder}`;
                        $(this).html(modifiedText);
                    }
                });

                // Get the modified HTML content from the jQuery object
                modifiedHtmlContent = $html.html();
                return modifiedHtmlContent;
            }





            // Helper function to get the current date in the desired format
            function getCurrentDate() {
                var today = new Date();
                var year = today.getFullYear();
                var month = String(today.getMonth() + 1).padStart(2, '0');
                var day = String(today.getDate()).padStart(2, '0');
                // return day + '/' + month + '/' + year;
                return "Sofort";
            }

            function updateCancellationState() {
                $("#dateInput").attr('disabled', true);
                const editorContent = $(".ql-editor").html();
                if (editorContent && editorContent.includes('[KUENDIGUNGSDATUM]')) {
                    $(".kuendigungsclass").attr('checked', false);
                    $(".kuendigungsclass").attr('disabled', false);
                    $(".labelkuendigungs").css('opacity', '');

                    cancellation_button.prop('disabled', true);
                } else {

                    $(".kuendigungsclass").attr('disabled', true);
                    $(".labelkuendigungs").css('opacity', '0.5');

                    setTimeout(function() {
                        $(".kuendigungsclass").prop('checked', false);
                        $('#dateInput').val('');
                    }, 50);

                    cancellation_button.prop('disabled', false);
                    cancellation_button_clicked = false;
                }
            }


            // const textInput = quill.root.innerHTML;
            function updateCancellationTypeState() {

                const editorContent = $(".ql-editor").html();
                if (editorContent && editorContent.includes('[KUENDIGUNGSTYP]')) {

                    $("#kuendigungstyp").attr('disabled', false);
                    $("#kuendigungstyp").css('opacity', '');

                    cancellationtype_button.prop('disabled', true);
                } else {
                    $("#kuendigungstyp").attr('disabled', true);
                    $("#kuendigungstyp").css('opacity', '0.5');

                    setTimeout(function() {
                        $("#kuendigungstyp").val("auswahl");
                    }, 50);
                    cancellationtype_button.prop('disabled', false);
                    cancellationtype_button_clicked = false;
                }
            }



            function updateButtonsState() {
                var hasSparte = form_templateSubject.val().includes('[BETREFF_SPARTE]');
                var hasPolizze = form_templateSubject.val().includes('[BETREFF_PolNr.]');
                betreff_sparte_button.prop('disabled', hasSparte);
                betreff_polizze_button.prop('disabled', hasPolizze);
                // console.log('BETREFF_SPARTE', hasSparte);
                // console.log('BETREFF_PolNr', hasPolizze);
                if (!hasSparte) {
                    betreff_sparte_button_clicked = false;
                    betreff_sparte_button.prop('disabled', false);
                }
                if (!hasPolizze) {
                    betreff_polizze_button_clicked = false;
                    betreff_polizze_button.prop('disabled', false);
                }
            }

            function isEditorEmpty() {
                const htmlContent = $(".ql-editor").html();
                const textContent = quill.getText().trim().replace(/\s/g, '');

                if (!quill.isEnabled() && (htmlContent.trim() !== '<p><br></p>')) {
                    // console.log("Editor is disabled and text exists already");
                    return false;
                } else if (!quill.isEnabled() && (textContent === '')) {
                    // console.log("Editor is disabled and not text exists");
                    return true;
                } else if (quill.isEnabled() && (textContent === '')) {
                    // console.log("isEnabled and does not contain text");
                    // return textContent === '';
                    return true;
                } else {
                    // console.log("isEnabled  and contains text");
                    return false;

                }
            }

            function toggleButtonState() {
                let editorIsEmpty = isEditorEmpty();

                if ((editorIsEmpty === false) && ($("#template_id").val() !== "") && (template_owner_id
                        .val() ===
                        employee)) {

                    $("#betreffInput").show();
                    previewButton.show();
                    saveButton.hide();
                    updateButton.show();
                    archiveButton.show();

                    previewButton.prop('disabled', editorIsEmpty);
                    saveButton.prop('disabled', editorIsEmpty);
                    updateButton.prop('disabled', editorIsEmpty);
                    archiveButton.prop('disabled', editorIsEmpty);

                    if (!shareTemplate) {
                        form_userOnly.prop('disabled', true);
                    } else {
                        form_userOnly.prop('disabled', editorIsEmpty);
                    }
                    form_templateName.prop('disabled', editorIsEmpty);
                    form_templateSubject.prop('disabled', editorIsEmpty);
                } else if ((editorIsEmpty === false) && ($("#template_id").val() === "") && (template_owner_id
                        .val() === employee)) {

                    $("#betreffInput").show();
                    previewButton.show();
                    saveButton.show();
                    updateButton.hide();
                    archiveButton.show();

                    previewButton.prop('disabled', editorIsEmpty);
                    saveButton.prop('disabled', editorIsEmpty);
                    updateButton.prop('disabled', editorIsEmpty);
                    archiveButton.prop('disabled', editorIsEmpty);

                    if (!shareTemplate) {
                        form_userOnly.prop('disabled', true);
                    } else {
                        form_userOnly.prop('disabled', editorIsEmpty);
                    }
                    form_templateName.prop('disabled', editorIsEmpty);
                    form_templateSubject.prop('disabled', editorIsEmpty);
                } else if ((editorIsEmpty === false) && ($("#template_id").val() !== "") && (template_owner_id
                        .val() !== employee)) {

                    $("#betreffInput").hide();
                    previewButton.show();
                    saveButton.hide();
                    updateButton.hide();
                    archiveButton.show();

                    previewButton.prop('disabled', editorIsEmpty);
                    saveButton.prop('disabled', editorIsEmpty);
                    updateButton.prop('disabled', editorIsEmpty);
                    archiveButton.prop('disabled', editorIsEmpty);

                    // for other user template from
                    if (!shareTemplate) {
                        form_userOnly.prop('disabled', true);
                    } else {
                        form_userOnly.prop('disabled', !editorIsEmpty);
                    }
                    form_templateName.prop('disabled', !editorIsEmpty);
                    form_templateSubject.prop('disabled', !editorIsEmpty);

                } else {
                    $("#betreffInput").hide();
                    previewButton.hide();
                    saveButton.hide();
                    updateButton.hide();
                    archiveButton.hide();

                    if (!shareTemplate) {
                        form_userOnly.prop('disabled', true);
                    } else {
                        form_userOnly.prop('disabled', editorIsEmpty);
                    }
                    form_templateName.prop('disabled', editorIsEmpty);
                    form_templateSubject.prop('disabled', editorIsEmpty);

                }
            }

            // Check the editor content on input
            quill.on('text-change', function() {
                toggleButtonState();
            });



            function insertTextAtCursorQuillEditor(text) {
                var selection = quill.getSelection();
                if (selection) {
                    quill.insertText(selection.index, text);
                    quill.setSelection(selection.index + text.length);
                }
            }


            function updateAllStates() {
                updateButtonsState();
                updateCancellationState();
                updateCancellationTypeState();
                toggleButtonState();
            }
            setInterval(updateAllStates, 100);
            // setInterval(() => editorCheck(), 100);
            // setInterval(() => updateButtonsState(), 100);
            // setInterval(() => updateCancellationState(), 100);
            // setInterval(() => toggleButtonState(), 100);
            // Combine all three functions into one


            loadFormCards(formDataForAlltemplates).then(response => {
                // console.log('Form cards loaded successfully:', response);
            }).catch(error => {
                console.error('Error loading form cards:', error);
            });

            // ============setInterVal functions and loadFormCards functions are end here================


            // 1=====================================function resetForm =====================================
            // 2=====================================function createFormData=================================
            // 3=====================================function updateFormData=================================
            // 4=====================================function templateLoading================================
            // 5=====================================function deleteFormData=================================
            // 6=====================================function loadFormCards==================================


            function resetForm() {
                $("#template_id").val('');
                $(".ql-editor").html('');
                form_templateSubject.val('');
                form_templateName.val('');
                // $(".kuendigungsclass").attr('checked', false);
                // $("#kuendigungstyp").val('auswahl');
                $('#calender_container').hide();
                betreff_sparte_button_clicked = false;
                betreff_polizze_button_clicked = false;
                cancellation_button_clicked = false;
                cancellationtype_button_clicked = false;
                $('#form_userOnly').prop('checked', false);

            }

            function createFormData(formData) {
                return new Promise((resolve, reject) => {

                    const fireAlertSave = () => {
                        Swal.fire({
                            title: 'Brief-Vorlage speichern?',
                            showDenyButton: true,
                            showCancelButton: true,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            confirmButtonText: 'Speichern',
                            denyButtonText: `Nicht Speichern`,
                            cancelButtonText: 'Abbruch',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            customClass: {
                                confirmButton: 'your-confirm-button-class',
                                denyButton: 'your-deny-button-class',
                                cancelButton: 'your-cancel-button-class',
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {

                                $.ajax({
                                    url: "{{ route('createtemplate') }}",
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                            .attr('content')
                                    },
                                    data: formData,
                                    dataType: 'json',
                                    beforeSend: function() {
                                        Swal.fire({
                                            title: 'Formular wird gespeichert...',
                                            text: 'Bitte warten Sie',
                                            showClass: {
                                                popup: 'animate__animated animate__fadeInDown'
                                            },
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            didOpen: () => {
                                                Swal.showLoading()
                                            }
                                        });
                                    },
                                    success: function(response) {
                                        resolve(response[0]);
                                    },
                                    error: function(xhr, status, error) {
                                        // Handle the error response
                                        console.error('Error updating data:',
                                            error);
                                        reject(error);
                                    }
                                });
                            } else if (result.isDenied) {
                                const createFormDataError = new Error();
                                createFormDataError.title = 'Speichern';
                                reject(createFormDataError); // Reject the promise
                            }
                        });
                    }
                    fireAlertSave();
                });
            }

            function updateFormData(formData) {
                return new Promise((resolve, reject) => {
                    const fireAlert = () => {

                        Swal.fire({
                            title: 'Brief-Vorlage speichern?',
                            showDenyButton: true,
                            showCancelButton: true,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            confirmButtonText: 'Speichern',
                            denyButtonText: `Nicht Speichern`,
                            cancelButtonText: 'Abbruch',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            customClass: {
                                confirmButton: 'your-confirm-button-class',
                                denyButton: 'your-deny-button-class',
                                cancelButton: 'your-cancel-button-class',
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {

                                $.ajax({
                                    url: "{{ route('updatetemplate') }}",
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                            .attr('content')
                                    },
                                    data: formData,
                                    dataType: 'json',
                                    beforeSend: function() {
                                        Swal.fire({
                                            title: 'Formular wird aktualisiert...',
                                            text: 'Bitte warten Sie',
                                            showClass: {
                                                popup: 'animate__animated animate__fadeInDown'
                                            },
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            didOpen: () => {
                                                Swal.showLoading()
                                            }
                                        });
                                    },
                                    success: function(response) {
                                        // Handle the success response
                                        // console.log('Data updated successfully:', response);
                                        resolve(
                                            response); // Resolve the promise
                                    },
                                    complete: function() {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Update completed',
                                            hideClass: {
                                                popup: 'animate__animated animate__fadeOutUp'
                                            },
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Download failed',
                                            text: error.message
                                        });
                                        console.error('Error updating data:',
                                            error);
                                        reject(error); // Reject the promise
                                    }
                                });
                            } else if (result.isDenied) {
                                const updateFormDataError = new Error();
                                updateFormDataError.title = 'Speichern';
                                reject(updateFormDataError);
                            }
                        });
                    };
                    fireAlert();
                });
            }

            function letterArchiving(formData) {
                return new Promise((resolve, reject) => {
                    const fireAlert = () => {

                        Swal.fire({
                            title: 'Diesen Brief im Vertragsordner hinterlegen?',
                            showDenyButton: true,
                            showCancelButton: true,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            confirmButtonText: 'Hinterlegen',
                            denyButtonText: `Nicht Hinterlegen`,
                            cancelButtonText: 'Abbruch',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            customClass: {
                                confirmButton: 'your-confirm-button-class',
                                denyButton: 'your-deny-button-class',
                                cancelButton: 'your-cancel-button-class',
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {

                                $.ajax({
                                    url: "{{ route('letter_submit') }}",
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                            .attr('content')
                                    },
                                    data: formData,
                                    dataType: 'json',
                                    beforeSend: function() {
                                        Swal.fire({
                                            title: 'Formular wird archiviert...',
                                            text: 'Bitte warten Sie',
                                            showClass: {
                                                popup: 'animate__animated animate__fadeInDown'
                                            },
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            didOpen: () => {
                                                Swal.showLoading()
                                            }
                                        });
                                    },
                                    success: function(response) {
                                        // Handle the success response
                                        console.log(
                                            'Data archived successfully:',
                                            response);
                                        resolve(
                                            response); // Resolve the promise
                                    },
                                    error: function(xhr, status, error) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Archive failed',
                                            text: error.message
                                        });
                                        console.error('Error Archiving data:',
                                            error);
                                        reject(error); // Reject the promise
                                    }
                                });
                            } else if (result.isDenied) {
                                const errorArchiving = new Error();
                                errorArchiving.title =
                                    'Hinterlegen'; // Add additional data to the error object
                                reject(errorArchiving);
                            }
                        });
                    };
                    fireAlert();
                });
            }

            function templateLoading(vertragId, templateId) {
                // $(".kuendigungsclass").attr('checked', false);
                $(".kuendigungsclass").prop('checked', false).trigger('change');
                $("#dateInput").val('');
                $("#kuendigungstyp").val('auswahl');
                return new Promise(function(resolve, reject) {
                    $.ajax({
                        url: "{{ route('gettemplate', ['id' => ':id', 'template_id_card' => ':template_id_card']) }}"
                            .replace(':id', vertragId).replace(':template_id_card', templateId),
                        method: 'GET',
                        dataType: 'json',
                        beforeSend: function() {
                            let timerInterval;
                            Swal.fire({
                                title: 'Formulare werden geladen !',
                                html: 'Es wird in <b></b> Millisekunden geschlossen.',
                                timer: 500,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer()
                                        .querySelector(
                                            'b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal
                                            .getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            });
                        },
                        success: function(response) {
                            // console.log(response);
                            const {
                                brokerID,
                                createdBy,
                                dateCreated,
                                dateModified,
                                id,
                                modifiedBy,
                                scopeContract,
                                scopeLetter,
                                templateBody,
                                templateName,
                                templateSubject,
                                type,
                                userID,
                                userOnly
                            } = response;


                            let text = "";
                            let tempText = "";

                            //    let text = templateBody.replace("data:text/plain;charset=UTF-8,", "");

                            if (templateBody.startsWith("data:text/plain;charset=UTF-8,")) {

                                text = templateBody.replace(
                                    "data:text/plain;charset=UTF-8,",
                                    "");

                            } else if (templateBody.startsWith(
                                    "data:text/plain;charset=utf-8,")) {

                                text = templateBody.replace(
                                    "data:text/plain;charset=utf-8,",
                                    "");

                            } else if (templateBody.startsWith(
                                    "data:text/html;charset=utf-8,")) {

                                tempText = templateBody.replace(
                                    "data:text/html;charset=utf-8,",
                                    "");
                                text = decodeURIComponent(tempText);

                            } else if (templateBody.startsWith("data:text/html;base64,")) {

                                tempText = templateBody.replace("data:text/html;base64,",
                                    "");

                                let responseDecodedData = atob(tempText);
                                let responseDecoder = new TextDecoder();
                                text = responseDecoder.decode(new Uint8Array(
                                    responseDecodedData
                                    .split('').map(function(c) {
                                        return c.charCodeAt(0);
                                    })));

                                // text = templateBody.replace("data:text/html;base64,", "");

                            } else {
                                text = templateBody;
                            }


                            // console.log(templateBody);
                            // console.log(text);
                            quill.enable();
                            $('.ql-editor').attr('data-placeholder', '');
                            quill.options.readOnly = false;
                            // console.log("checkBefore",text);
                            quill.root.innerHTML = text;
                            let checkAfter = $(".ql-editor").html();
                            // console.log("checkAfter",checkAfter);




                            form_templateSubject.val(templateSubject);
                            form_templateName.val(templateName);
                            template_id.val(id);
                            template_owner_id.val(userID);


                            // Set userOnly value to toggle button
                            if ((userOnly === false) && (employee !== userID)) {
                                $('#form_userOnly').prop('checked', true);
                                $("#editor").css("background-color", "#E9ECEF");
                                quill.enable(false);
                                // console.log(userOnly, userID);
                            } else if ((userOnly === false) && (employee === userID)) {
                                $('#form_userOnly').prop('checked', true);
                                $("#editor").css("background-color", "");
                                quill.enable();
                                // console.log(userOnly, userID);
                            } else if ((userOnly) && (employee === userID)) {
                                $('#form_userOnly').prop('checked', false);
                                $("#editor").css("background-color", "");
                                quill.enable();
                                // console.log(userOnly, userID);
                            }
                            resolve(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(error); // Handle the error case
                            reject(error);
                        }
                    });
                });
            }

            function deleteFormData(formDataForDelete) {

                return new Promise((resolve, reject) => {
                    Swal.fire({
                        title: 'Möchten Sie die Vorlage löschen?',
                        showDenyButton: true,
                        showCancelButton: true,
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        confirmButtonText: 'löschen',
                        denyButtonText: `Nicht löschen`,
                        cancelButtonText: 'Abbruch',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        customClass: {
                            confirmButton: 'your-confirm-button-class',
                            denyButton: 'your-deny-button-class',
                            cancelButton: 'your-cancel-button-class',
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('deletetemplate') }}",
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                data: formDataForDelete,
                                dataType: 'json',
                                beforeSend: function() {
                                    Swal.fire({
                                        icon: 'Erfolg',
                                        title: 'Das Formular wird gelöscht !',
                                        hideClass: {
                                            popup: 'animate__animated animate__fadeOutUp'
                                        },
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                },
                                success: function(response) {
                                    resolve(response);
                                },
                                error: function(xhr, status, error) {
                                    // Handle the error response
                                    console.error('Error updating data:', error);
                                    reject(error);
                                }
                            });
                        } else if (result.isDenied) {

                            reject(new Error(
                                'Formularlöschung abgebrochen.')); // Reject the promise
                        }
                    });



                });
            }

            function loadFormCards(formData, activeTemplateId = null) {

                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: "{{ route('getcontracttemplatesdata') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        dataType: 'json',
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Vorlagen werden geladen...',
                                text: 'Bitte warten Sie',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            });
                        },
                        success: function(response) {
                            $('#formCards').empty();
                            // data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                            let newForm =
                                `<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                                       <div id="new_template_create" class="icon-card mb-30 " style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <div class="icon purple">
                                        <i class="lni lni-plus"></i>
                                        </div>
                                        <div class="content">
                                        <h6 class="mb-10">Neuer Brief</h6>
                                        </div>
                                    </div>
                                    </div>`;
                            if (createTemplate) {
                                $('#formCards').append(newForm);
                            }
                            // console.log(response);

                            if (response && response.length > 0) {
                                response.sort((a, b) => parseInt(a.id) - parseInt(b.id));

                                let filterResponse = response.filter(function(obj) {
                                    return obj.type === templateType;
                                });
                                // console.log("after sorting");
                                // console.log("filtered_VN_VU : ",filterResponse);

                                $.each(filterResponse, function(index, form) {
                                    // let dateModified = form.dateModified.split(' ')[0];
                                    // Input date string
                                    let dateModified = form.dateModified;
                                    // Create a Date object from the input string
                                    const dateObject = new Date(dateModified);

                                    // Get day, month, and year from the date object
                                    const day = dateObject.getDate().toString()
                                        .padStart(2, '0');
                                    const month = (dateObject.getMonth() + 1)
                                        .toString().padStart(2, '0');
                                    const year = dateObject.getFullYear();
                                    dateModified = `${day}.${month}.${year}`;


                                    // let templateName = form.templateName;
                                    // let truncatedName = templateName.length > 16 ?
                                    //     templateName.substring(0, 16) + "..." :
                                    //     templateName;

                                    let templateName = form.templateName;
                                    let truncatedName = templateName.length > 16 ?
                                        templateName.substring(0, 13) + '\u2026' :
                                        templateName;

                                    // let templateSubject = form.templateSubject;
                                    // let truncatedSubjectName = templateSubject.length >10 ?
                                    //      templateSubject.substring(0, 16) + ".." :
                                    //     templateSubject;

                                    let activeCardTemplates = (employee === form
                                        .userID) ? "bg-own" : "bg-other";
                                    let activeCardTemplatesSub = (employee === form
                                        .userID) ? "text-own" : "text-other";
                                    let delete_id = (employee === form.userID) ?
                                        form
                                        .id : '';
                                    let modifiedUserOnly = form.userOnly;
                                    // console.log(activeTemplateId);
                                    //   ==================


                                    //   ==================
                                    // data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    //  <span class="text-gray">${dateModified}</span>${truncatedSubjectName}
                                    var cardHtml = `
                                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                                                    <div id="${form.id}" class="icon-card mb-30 form-link custom-tooltip ${activeCardTemplates}" title="${templateName}" 
                                                                style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    <div class="content">
                                                        <h6 class="mb-10">${truncatedName}</h6>
                                                        <p class="text-sm ${activeCardTemplatesSub}">
                                                        <i class="lni lni-arrow-right"></i>${dateModified}<br/>
                                                        <span class="text-gray">${form.modifiedByName}</span><br/>
                                                        </p>
                                                        ${employee === form.userID ? (modifiedUserOnly ? 
                                                            `<p class="bg-success text-center text-white text-sm rounded-1">nur für Sie</p>` 
                                                            : 
                                                            `<p class="bg-info text-center text-white text-sm rounded-1">für alle</p>`
                                                            ):
                                                             ``}
                                                    </div>
                                                    ${(delete_id) ? `
                                                            <button id="delete_id_${delete_id}" class="text-danger custom-delete" style="position: absolute; bottom: 10px; right: 10px; border: none;">
                                                            <i class="lni lni-trash-can"></i>
                                                            </button>` : ''}
                                                    </div>
                                                </div>`;

                                    $('#formCards').append(cardHtml);

                                    if ((form.id === activeTemplateId) && (
                                            activeTemplateId !== null)) {
                                        $(`#${form.id}`).addClass("highlight");
                                        setTimeout(function() {
                                            $(`#${form.id}`).removeClass(
                                                "highlight");
                                        }, 10000);
                                    }

                                });

                            }

                            resolve(response); // Resolve the promise
                        },
                        complete: function() {
                            Swal.close();
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Beim Laden der Karten ist ein Fehler aufgetreten.'
                            });
                            console.error('Error loading data:', error);
                            reject(error); // Reject the promise
                        }
                    });
                });
            }



            // ===================================buttons click envents ==================================================
            // ===================================buttons click envents ==================================================
            // ===================================buttons click envents ==================================================
            // ===================================buttons click envents ==================================================


            $('#polizzeButton').click(function(e) {
                e.preventDefault();
                if (!quill.isEnabled()) {
                    // Quill editor is read-only, do not insert the span node
                    return;
                }
                insertTextAtCursorQuillEditor('[POLIZZEN_NR.]');
            });

            $('#sparteButton').click(function(e) {
                e.preventDefault();
                if (!quill.isEnabled()) {
                    return;
                }
                insertTextAtCursorQuillEditor('[SPARTE]');
            });

            $('#begindatumButton').click(function(e) {
                e.preventDefault();
                if (!quill.isEnabled()) {
                    return;
                }
                insertTextAtCursorQuillEditor('[BEGINDATUM]');
            });

            $('#nameOfCustomerButton').click(function(e) {
                e.preventDefault();
                if (!quill.isEnabled()) {
                    return;
                }
                insertTextAtCursorQuillEditor('[KUNDE_FIRMA_NAME]');
            });

            $('#geburtsdatumButton').click(function(e) {
                e.preventDefault();
                if (!quill.isEnabled()) {
                    return;
                }
                insertTextAtCursorQuillEditor('[GEBURTS_GRUENDUNGS_DATUM]');
            });

            $('#ansprechpartnerButton').click(function(e) {
                e.preventDefault();
                if (!quill.isEnabled()) {
                    return;
                }
                insertTextAtCursorQuillEditor('[ANSPRECHPARTNER]');
            });


            cancellation_button.on("click", function(e) {
                e.preventDefault();
                if (cancellation_button_clicked) return;

                if (!quill.isEnabled()) return;

                insertTextAtCursorQuillEditor('[KUENDIGUNGSDATUM]');
                cancellation_button.prop('disabled', true);
                cancellation_button_clicked = true;
            });


            cancellationtype_button.on("click", function(e) {
                e.preventDefault();
                if (cancellationtype_button_clicked) return;

                if (!quill.isEnabled()) return;

                insertTextAtCursorQuillEditor('[KUENDIGUNGSTYP]');
                cancellationtype_button.prop('disabled', true);
                cancellationtype_button_clicked = true;
            });


            betreff_sparte_button.on("click", function(e) {
                e.preventDefault();

                if (betreff_sparte_button_clicked) return;

                insertTextAtCursor('[BETREFF_SPARTE]');

                betreff_sparte_button.prop('disabled', true);
                betreff_sparte_button_clicked = true;
            });

            betreff_polizze_button.on("click", function(e) {
                e.preventDefault();

                if (betreff_polizze_button_clicked) return;


                insertTextAtCursor('[BETREFF_PolNr.]');

                betreff_polizze_button.prop('disabled', true);
                betreff_polizze_button_clicked = true;
            });


            function insertTextAtCursor(textToInsert) {
                const input = form_templateSubject[0]; // Get the actual DOM element from the jQuery object
                const startPos = input.selectionStart;
                const endPos = input.selectionEnd;

                // Get the text before and after the cursor position
                const value = input.value;
                const beforeText = value.substring(0, startPos);
                const afterText = value.substring(endPos, value.length);

                // Update the input value with the new text
                input.value = beforeText + textToInsert + afterText;
                // Set the new cursor position after the inserted text
                input.selectionStart = startPos + textToInsert.length;
                input.selectionEnd = startPos + textToInsert.length;

                // Trigger the input event manually to update any other event listeners
                $(input).trigger('input');
            }


            // ===================================buttons click envents end =========================================
            // ===================================buttons click envents end =========================================



            // =========================================================================================================
            // =========================================================================================================

            // =========================================================================================================
            // =========================================================================================================
            // ==========================call for creating the new template and create button click ====================
            // ==========================call for creating the new template and create button click ====================
            // =========================================================================================================
            // =========================================================================================================


            $('#formCards').on('click', '#new_template_create', function(e) {
                e.preventDefault();
                resetForm();
                Swal.fire({
                    title: 'bitte warten, Editor ist aktiv!',
                    html: 'Es wird geschlossen in <b></b> Millisekunden.',
                    timer: 500,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                });

                quill.enable();
                quill.options.readOnly = false;
                $('#staticBackdrop').on('shown.bs.modal', function() {
                    setTimeout(function() {
                        quill.focus();
                    }, 100);
                });
                template_owner_id.val(employee);

            });


            $('button[name="save"]').click(function(e) {
                event.preventDefault();

                const userOnlyValue = $('#form_userOnly').is(':checked') ? 'false' : 'true';

                const templateNameValue = form_templateName.val().replace(/(<([^>]+)>)/ig, "");
                const templateSubjectValue = form_templateSubject.val().replace(/(<([^>]+)>)/ig, "");

                // Get the textarea content
                const textarea = $(".ql-editor");
                const sourceCodeHtmlContent = textarea.html();
                let showingNode = sourceCodeHtmlContent.replace(/[\u200B-\u200D\uFEFF]/gim, '');
                // sourceCodeHtmlContent.innerHTML = showingNode;
                showingNode = modifyParagraphs(showingNode, placeHolder_1);
                showingNode = modifyParagraphs(showingNode, placeHolder_2);


                // console.log(sourceCodeHtmlContent);
                // console.log(showingNode);

                if ((templateNameValue.length < 6) || (templateSubjectValue.length < 6) || (
                        showingNode ===
                        '<p><br></p>')) {
                    Swal.fire({
                        icon: 'error',
                        title: `Speichern noch nicht möglich`,
                        // text: 'Betreffzeile muss befüllt sein \nVorlagen-Name muss befüllt sein',
                        html: 'Betreffzeile muss befüllt sein<br>Vorlagen-Name muss befüllt sein',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    });
                    return;
                }

                // ===data:text/plain;charset=UTF-8 ==========
                const plainTextContent = quill.getText();
                const formattedContent = plainTextContent.replace(/\n/g, '\r\n');
                const templateBody1 = "data:text/plain;charset=UTF-8," + formattedContent;
                // console.log(templateBody1);


                // ===data:text/html;charset=utf-8 ==========

                console.log("br", showingNode);
                const encodeURIComponentHTML = encodeURIComponent(showingNode);
                const templateBody2 = "data:text/html;charset=utf-8," + encodeURIComponentHTML;
                // console.log(templateBody2);


                // const decodeURIComponentHtml = decodeURIComponent(encodeURIComponentHTML);
                // console.log("dURI "+ decodeURIComponentHtml);

                // ===data:text/html;base64, ==========

                // Encode the string
                // var encoder = new TextEncoder();
                // var data = encoder.encode(showingNode);
                // var encodedText = btoa(String.fromCharCode.apply(null, data));
                // console.log("encoded "+ encodedText);

                const base64HTML = Base64.encode(showingNode);
                const templateBody3 = "data:text/html;base64," + base64HTML;


                const decodedData = atob(base64HTML);
                let decoder = new TextDecoder();
                const decodedText = decoder.decode(new Uint8Array(decodedData.split('').map(function(
                    c) {
                    return c.charCodeAt(0);
                })));


                const formData = {
                    vertragId: vertragId,
                    template_type: templateType,
                    form_userOnly: JSON.parse(userOnlyValue),
                    form_templateName: templateNameValue,
                    form_templateSubject: templateSubjectValue,
                    form_templateBody: templateBody3
                };
                console.log(formData);

                createFormData(formData)
                    .then((response) => {
                        $('#closeButton').trigger('click');
                        resetForm();
                        return loadFormCards(formDataForAlltemplates, response.id);
                    }).catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            iconSize: 16,
                            title: `Abbruch: ${error.title}`,
                            text: error.message,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        });
                    });

            });



            //========================== save close here=====================================


            // =========================================================================================================
            // =========================================================================================================
            // ==========================call the specific template and update button click ============================
            // ==========================call the specific template and update button click ============================
            // =========================================================================================================
            // =========================================================================================================


            $('#formCards').on('click', '.form-link', function(e) {
                e.preventDefault();
                const template_id_card = $(this).attr('id');
                templateLoading(vertragId, template_id_card).then(response => {}).catch(error => {
                    console.error('Error loading form cards:', error);
                });

            });


            $('button[name="update"]').click(function(e) {
                e.preventDefault();

                const template_id_value = template_id.val();
                const userOnlyValue = $('#form_userOnly').is(':checked') ? 'false' : 'true';


                const templateNameValue = form_templateName.val().replace(/(<([^>]+)>)/ig, "");
                const templateSubjectValue = form_templateSubject.val().replace(/(<([^>]+)>)/ig, "");

                if ((templateNameValue.length < 6) || (templateSubjectValue.length < 6)) {

                    Swal.fire({
                        icon: 'error',
                        title: `Update noch nicht möglich`,
                        // text: 'Betreffzeile muss befüllt sein \nVorlagen-Name muss befüllt sein',
                        html: 'Betreffzeile muss befüllt sein<br>Vorlagen-Name muss befüllt sein',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    });
                    return;
                }
                // Get the textarea content
                const textarea = $(".ql-editor");
                const sourceCodeHtmlContent = textarea.html();

                let showingNode = sourceCodeHtmlContent.replace(/[\u200B-\u200D\uFEFF]/gim, '');
                // sourceCodeHtmlContent.innerHTML = showingNode;
                showingNode = modifyParagraphs(showingNode, placeHolder_1);
                showingNode = modifyParagraphs(showingNode, placeHolder_2);
                // console.log(sourceCodeHtmlContent);
                // console.log(showingNode);




                // ===data:text/plain;charset=UTF-8 ==========
                const plainTextContent = quill.getText();
                const formattedContent = plainTextContent.replace(/\n/g, '\r\n');
                const templateBody1 = "data:text/plain;charset=UTF-8," + formattedContent;
                // console.log(templateBody1);


                // ===data:text/html;charset=utf-8 ==========

                const encodeURIComponentHTML = encodeURIComponent(showingNode);
                const templateBody2 = "data:text/html;charset=utf-8," + encodeURIComponentHTML;


                const base64HTML = Base64.encode(showingNode);
                const templateBody3 = "data:text/html;base64," + base64HTML;

                // console.log(base64HTML);

                const decodedData = atob(base64HTML);
                let decoder = new TextDecoder();
                const decodedText = decoder.decode(new Uint8Array(decodedData.split('').map(function(
                    c) {
                    return c.charCodeAt(0);
                })));
                // console.log(decodedText);

                const formData = {
                    vertragId: vertragId,
                    template_id: template_id_value,
                    template_type: templateType,
                    form_userOnly: JSON.parse(userOnlyValue),
                    form_templateName: templateNameValue,
                    form_templateSubject: templateSubjectValue,
                    form_templateBody: templateBody3
                };

                updateFormData(formData)
                    .then((response) => {
                        $('#closeButton').trigger('click');
                        resetForm();
                        return loadFormCards(formDataForAlltemplates, response.id);
                    }).catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            iconSize: 16,
                            title: `Abbruch: ${error.title}`,
                            text: error.message,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        });
                    });

                quill.options.readOnly = true;

            });


            //========================== update close here=====================================


            // =========================================================================================================
            // =========================================================================================================
            // ==========================delete the specific template and delete button click ==========================
            // ==========================delete the specific template and delete button click ==========================
            // =========================================================================================================
            // =========================================================================================================



            $('#formCards').on('click', '.custom-delete', function(event) {

                event.preventDefault();
                event.stopPropagation();


                const deleteButtonId = $(this).attr('id');
                const cardId = deleteButtonId.split('_')[
                    2]; // Extract the card ID from the delete button ID


                templateLoading(vertragId, cardId)
                    .then(() => {
                        const formDataForDelete = {
                            id: vertragId,
                            formId: cardId
                        };

                        return deleteFormData(formDataForDelete);
                    })
                    .then((response) => {
                        resetForm();
                        $('#closeButton').trigger('click');
                        return loadFormCards(formDataForAlltemplates);
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error.message,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        });
                    });

            });


            // ======================================= delete button closed here =======================================






            //========================== disable for edit form  start here=====================================
            //========================== disable for edit form  start here=====================================
            //========================== disable for edit form  start here=====================================


            $("#formcreating").on("click", function(e) {

                const test_template_owner_id = template_owner_id.val().trim();

                // if ((!$(e.target).is("#previewButton")) &&
                //     (!$(e.target).is("#archiveButton")) &&
                //     (!$(e.target).is("#radioCurrentDate")) &&
                //     (!$(e.target).is("#radioWantedDate")) &&
                //     (!$(e.target).is("#selectionId")) &&
                //     (!$(e.target).is("#kuendigungstyp")) &&
                //     (!$(e.target).is("#calender_container")) &&
                //     (!$(e.target).hasClass("ui-icon")) &&
                //     (employee !== test_template_owner_id) && 
                //     (test_template_owner_id !== '')) {



                if (($(e.target).is("#editor") ||
                        $(e.target).is(".ql-toolbar") ||
                        $(e.target).is("#buttonsdiv")) && ((employee !== test_template_owner_id) &&
                        (test_template_owner_id !== ''))) {

                    e.preventDefault();

                    // console.log("test_0",test_template_owner_id);
                    Swal.fire({
                        title: 'Änderungen nicht zulässig!',
                        text: 'Nur der Besitzer darf diese Brief-Vorlage abändern.',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        },
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    })

                } else if ((employee === test_template_owner_id)) {
                    return;
                } else {

                    return;
                }
            });

            // ================================================


            //========================== disable for edit form  close here=====================================
            //========================== disable for edit form  close here=====================================
            //========================== disable for edit form  close here=====================================



            // ==========================call for pdf preview the creating template ====================================
            // ==========================call for pdf preview the creating template ====================================
            // =========================================================================================================
            // =========================================================================================================

            // Add click event listener to the preview button


            $('button[name="preview"]').click(function(e) {
                e.preventDefault();

                function isEditorEmpty() {
                    const text = quill.getText().trim();
                    return text.length === 0;
                }
                const empty = isEditorEmpty();


                const polizzenNrValue = "{{ $policyNumber }}";
                const sparteValue = "{{ $sparte }}";
                const begindatumValue = "{{ $beginnDatum }}";

                const kunde_firma_Value = "{{ $nameOfCustomer }}";
                const geb_gegr_Value = "{{ $geburts_oder_gruendungs_datum }}";
                const ansprechPartner_Value = "{{ $ansprechpartner }}";


                const templateNameValue = form_templateName.val().replace(/(<([^>]+)>)/ig, "");
                const templateSubjectValue = form_templateSubject.val().replace(/(<([^>]+)>)/ig, "");

                let form_templateCancellationDate_Value = form_templateCancellationDate.val();
                console.log(form_templateCancellationDate_Value);
                let form_templateCancellationTye_Value = form_templateCancellationTye.val();
                console.log(form_templateCancellationTye_Value);



                if ((templateNameValue.length < 6) || (templateSubjectValue.length < 6)) {
                    Swal.fire({
                        icon: 'error',
                        title: `Vorschau noch nicht möglich`,
                        // text: 'Betreffzeile muss befüllt sein \nVorlagen-Name muss befüllt sein',
                        html: 'Die Betreffzeile muss befüllt sein.<br>Vorlagen-Name muss aus min. 6 Buchstaben bestehen.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    });
                    return;
                }


                // Get the text input from the Quill editor
                const textarea = $(".ql-editor");
                const sourceCodeHtmlContent = textarea.html();


                let showingNode = sourceCodeHtmlContent.replace(/[\u200B-\u200D\uFEFF]/gim, '');
                // sourceCodeHtmlContent.innerHTML = showingNode;
                showingNode = modifyParagraphs(showingNode, placeHolder_1);
                showingNode = modifyParagraphs(showingNode, placeHolder_2);
                // console.log("testHtml");
                // console.log(showingNode);

                if (showingNode.includes(placeHolder_1)) {
                    if (!(form_templateCancellationDate_Value === '')) {
                        if (form_templateCancellationDate_Value === 'Sofort') {
                            form_templateCancellationDate_Value =
                                `Zeitpunkt der Kündigung:<br>sofort (d.h. zum nächsten möglichen Zeitpunkt)`;
                        } else {
                            form_templateCancellationDate_Value =
                                `Zeitpunkt der Kündigung:<br>${$('#dateInput').val()} <br>Falls an diesem Zeitpunkt die Kündigung nicht möglich sein sollte, gilt sie automatisch zum nächstmöglichen Zeitpunkt (OGH-Urteile 7Ob210/03p und 7Ob272/04g)`;
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: `Vorschau noch nicht möglich`,
                            html: 'Kündigungsdatum muss befüllt sein',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        });
                        return;
                    }
                }

                if (showingNode.includes(placeHolder_2)) {
                    if (!(form_templateCancellationTye_Value === 'auswahl') ||
                        ((form_templateCancellationTye_Value === 'auswahl') && lengthCancellationType ==
                            0)) {
                        if (form_templateCancellationTye_Value === 'auswahl') {
                            form_templateCancellationTye_Value = `Kündigungsart:<br>Kein Typ vorhanden`;
                        } else if (form_templateCancellationTye_Value === 'ohnegrund') {
                            form_templateCancellationTye_Value = ``;
                        } else {

                            if (form_templateCancellationTye_Value.includes("`br`")) {
                                const form_templateCancellationTye_Value_with_br =
                                    form_templateCancellationTye_Value.replace(/`br`/g, '<br>');
                                form_templateCancellationTye_Value =
                                    `Kündigungsart:<br>${form_templateCancellationTye_Value_with_br}`;
                            } else {
                                form_templateCancellationTye_Value =
                                    `Kündigungsart:<br>${form_templateCancellationTye_Value}`;
                            }
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: `Vorschau noch nicht möglich`,
                            html: 'KündigungsTyp muss befüllt sein',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        });
                        return;

                    }

                }

                let htmlText = showingNode;
                // console.log("preview");
                // console.log(htmlText);

                htmlText = htmlText.replace(/\[KUENDIGUNGSDATUM\]/g,
                    form_templateCancellationDate_Value);

                htmlText = htmlText.replace(/\[KUENDIGUNGSTYP\]/g, form_templateCancellationTye_Value);

                htmlText = htmlText.replace(/\[POLIZZEN_NR.\]/g, polizzenNrValue);

                htmlText = htmlText.replace(/\[SPARTE\]/g, sparteValue);

                htmlText = htmlText.replace(/\[BEGINDATUM\]/g, begindatumValue);

                htmlText = htmlText.replace(/\[KUNDE_FIRMA_NAME\]/g, kunde_firma_Value);

                htmlText = htmlText.replace(/\[GEBURTS_GRUENDUNGS_DATUM\]/g, geb_gegr_Value);

                htmlText = htmlText.replace(/\[ANSPRECHPARTNER\]/g, ansprechPartner_Value);



                const base64Text = Base64.encode(htmlText);
                const jsonString = JSON.stringify(base64Text);
                // console.log("test",htmlText);

                const betreff_text_value = form_templateSubject.val();
                let betreff_text = betreff_text_value;

                betreff_text = betreff_text.replace(/\[BETREFF_SPARTE\]/g, sparteValue);
                betreff_text = betreff_text.replace(/\[BETREFF_PolNr.\]/g, polizzenNrValue);



                $.ajax({
                    url: "{{ route('pdftest') }}",
                    cache: true,
                    type: "POST",
                    data: {
                        base64Text: jsonString,
                        betreff_text: betreff_text,
                        vertragId: vertragId,
                        requestfrom: null
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Vorlagen wird gezeicht...',
                            text: 'Bitte warten',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                    },
                    success: function(response) {
                        if (response) {
                            Swal.close();
                            // Convert the base64 PDF data to binary
                            var binaryStream = new Uint8Array(atob(response.pdf).split('')
                                .map(
                                    function(c) {
                                        return c.charCodeAt(0);
                                    }));

                            // Create a Blob with the binary data
                            var blob = new Blob([binaryStream], {
                                type: 'application/pdf'
                            });

                            // Create a URL for the Blob
                            var fileURL = URL.createObjectURL(blob);

                            // Open the PDF in a new window
                            var pdfData = "data:application/pdf;base64," + response.pdf;
                            var previewWindow = window.open('', '_blank',
                                'width=700,height=950');
                            previewWindow.document.write(
                                '<iframe width="100%" height="100%" src="' + pdfData +
                                '"></iframe>');
                        }
                        // console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        Swal.close();
                    }
                });
            });


            //============================================== pdf preview close here ====================================
            // ============================================= pdf preview close here ====================================
            // ============================================= pdf preview close here ====================================



            //========================== data is archiving after archive botton clicks =========================
            //========================== data is archiving after archive botton clicks =========================
            //========================== data is archiving after archive botton clicks =========================


            $('button[name="archive"]').click(function(event) {
                event.preventDefault();

                const template_id_value = template_id.val();
                const userOnlyValue = $('#form_userOnly').is(':checked') ? 'false' : 'true';


                const polizzenNrValue = "{{ $policyNumber }}";
                const sparteValue = "{{ $sparte }}";
                const begindatumValue = "{{ $beginnDatum }}";

                const kunde_firma_Value = "{{ $nameOfCustomer }}";
                const geb_gegr_Value = "{{ $geburts_oder_gruendungs_datum }}";
                const ansprechPartner_Value = "{{ $ansprechpartner }}";

                const templateNameValue = form_templateName.val().replace(/(<([^>]+)>)/ig, "");
                const templateSubjectValue = form_templateSubject.val().replace(/(<([^>]+)>)/ig, "");

                let form_templateCancellationDate_Value = form_templateCancellationDate.val();
                // console.log(form_templateCancellationDate_Value);
                let form_templateCancellationTye_Value = form_templateCancellationTye.val();
                // console.log(form_templateCancellationTye_Value);



                if ((templateNameValue.length < 6) || (templateSubjectValue.length < 6)) {

                    Swal.fire({
                        icon: 'error',
                        title: `Hinterlegen noch nicht möglich`,
                        // text: 'Betreffzeile muss befüllt sein \nVorlagen-Name muss befüllt sein',
                        html: 'Betreffzeile muss befüllt sein<br>Vorlagen-Name muss befüllt sein',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    });
                    return;
                }

                // Get the textarea content
                const textarea = $(".ql-editor");
                const sourceCodeHtmlContent = textarea.html();
                let showingNode = sourceCodeHtmlContent.replace(/[\u200B-\u200D\uFEFF]/gim, '');
                showingNode = modifyParagraphs(showingNode, placeHolder_1);
                showingNode = modifyParagraphs(showingNode, placeHolder_2);

                console.log("testHtmlArchive");
                console.log(showingNode);



                if (showingNode.includes(placeHolder_1)) {
                    if (!(form_templateCancellationDate_Value === '')) {

                        if (form_templateCancellationDate_Value === 'Sofort') {
                            form_templateCancellationDate_Value =
                                `Zeitpunkt der Kündigung:<br>sofort (d.h. zum nächsten möglichen Zeitpunkt)`;
                        } else {
                            form_templateCancellationDate_Value =
                                `Zeitpunkt der Kündigung:<br>${$('#dateInput').val()} <br>Falls an diesem Zeitpunkt die Kündigung nicht möglich sein sollte, gilt sie automatisch zum nächstmöglichen Zeitpunkt (OGH-Urteile 7Ob210/03p und 7Ob272/04g)`;
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: `Hinterlegen noch nicht möglich`,
                            html: 'Kündigungsdatum muss befüllt sein',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        });
                        return;
                    }
                }

                if (showingNode.includes(placeHolder_2)) {
                    if (!(form_templateCancellationTye_Value === 'auswahl') ||
                        ((form_templateCancellationTye_Value === 'auswahl') && lengthCancellationType ==
                            0)) {

                        if (form_templateCancellationTye_Value === 'auswahl') {
                            form_templateCancellationTye_Value = `Kündigungsart:<br>Kein Typ vorhanden`;
                        } else if (form_templateCancellationTye_Value === 'ohnegrund') {
                            form_templateCancellationTye_Value = ``;
                        } else {
                            if (form_templateCancellationTye_Value.includes("`br`")) {
                                const form_templateCancellationTye_Value_with_br =
                                    form_templateCancellationTye_Value.replace(/`br`/g, '<br>');
                                form_templateCancellationTye_Value =
                                    `Kündigungsart:<br>${form_templateCancellationTye_Value_with_br}`;
                            } else {
                                form_templateCancellationTye_Value =
                                    `Kündigungsart:<br>${form_templateCancellationTye_Value}`;
                            }
                        }

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: `Hinterlegen noch nicht möglich`,
                            html: 'KündigungsTyp muss befüllt sein',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        });
                        return;
                    }
                }

                let htmlText = showingNode;
                console.log("Archive");
                console.log(htmlText);




                htmlText = htmlText.replace(/\[KUENDIGUNGSDATUM\]/g,
                    form_templateCancellationDate_Value);

                htmlText = htmlText.replace(/\[KUENDIGUNGSTYP\]/g, form_templateCancellationTye_Value);

                htmlText = htmlText.replace(/\[POLIZZEN_NR.\]/g, polizzenNrValue);

                htmlText = htmlText.replace(/\[SPARTE\]/g, sparteValue);

                htmlText = htmlText.replace(/\[BEGINDATUM\]/g, begindatumValue);

                htmlText = htmlText.replace(/\[KUNDE_FIRMA_NAME\]/g, kunde_firma_Value);

                htmlText = htmlText.replace(/\[GEBURTS_GRUENDUNGS_DATUM\]/g, geb_gegr_Value);

                htmlText = htmlText.replace(/\[ANSPRECHPARTNER\]/g, ansprechPartner_Value);


                const base64Text = Base64.encode(htmlText);
                const jsonString = JSON.stringify(base64Text);

                const betreff_text_value = form_templateSubject.val();
                let betreff_text = betreff_text_value;

                betreff_text = betreff_text.replace(/\[BETREFF_SPARTE\]/g, sparteValue);
                betreff_text = betreff_text.replace(/\[BETREFF_PolNr.\]/g, polizzenNrValue);



                const formData = {
                    vertragId: vertragId,
                    betreff_text: betreff_text,
                    base64Text: jsonString,
                    requestFrom: null
                };

                console.log(formData);


                letterArchiving(formData)
                    .then((response) => {
                        $('#closeButton').trigger('click');
                        resetForm();
                        Swal.fire({
                            icon: 'success',
                            title: 'Brief erfolgreich hinterlegt',
                            html: 'Weiter <a href="' + response.redirectUrl +
                                '">hier zum hinterlegten Brief</a>',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            },
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            customClass: {
                                confirmButton: 'my-hinterlegt-ok-btn' // Add a CSS class for the OK button
                            },
                            // buttonsStyling: false 
                        });


                        console.log(response.redirectUrl);
                        // return loadFormCards(formDataForAlltemplates,response.id);
                    }).catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            iconSize: 16,
                            title: `Abbruch: ${error.title}`,
                            text: error.message,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        });
                    });
                quill.options.readOnly = true;
                return;



            });

            //================================ archive botton is closed =========================================
            //================================ archive botton is closed =========================================
            //================================ archive botton is closed =========================================

            //===========final =====================

        });
        </script>


        {{-- -------------- --}}

        <!-- end row -->
    </div>
    <!-- ========== form-elements-wrapper end ========== -->
</div>
@endsection