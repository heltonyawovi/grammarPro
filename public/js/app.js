
$(function () {
    $(document).ready(function () {
        $(".form-grammarPro").each(function (index) {
            var thisForm = $(this);
            //alert(thisForm.html());
            //alert("#" + thisForm.attr("id"));
            thisForm.submit(function (e) {
                e.preventDefault();
                // alert("ues");
                if (!thisForm.hasClass("disabled")) {
                    // if (!thisForm.hasClass("disabled") && thisForm.find(".manuscript-textarea").val().trim() != "") {
                    thisForm.addClass("disabled");
                    show($(".loading-components"));
                    // show($(".results-container"), true);
                    show($(".results-container[data-target='" + thisForm.attr("data-target") + "']"), true);
                    // $(".result-list").html("");
                    $(".result-list[data-target='" + thisForm.attr("data-target") + "']").html("");

                    var form = $(this);
                    //alert("#" + thisForm.attr("id"));
                    //var form = $("#" + $(this).attr("id"));
                    //alert(form.html());
                    //var dataKeywordsExtraction = { q: $(".manuscript-textarea").val() };

                    var url = form.attr("action") + form.attr("data-task")
                    // + "?" + form.attr("data-params");
                    // alert(url);
                    var method = form.attr("method");
                    //alert(method);
                    $("#form-data-params").remove();
                    $("<input />").attr("type", "hidden")
                        .attr("id", "form-data-params")
                        .attr("value", form.attr("data-params"))
                        .attr("name", "params")
                        .appendTo(thisForm);
                    // form.append({"params":form.attr("data-params")});
                    var data = form.serialize();
                    // $(".result-list").html(data);
                    // alert(data);
                    // return;

                    ajaxRequest(url, method, data, function (data) {
                        //ajaxRequest(KEYWORDS_EXTRACTION_SERVER_URL, METHOD_GET, dataKeywordsExtraction, function (data) {
                        //alert(JSON.stringify(data));
                        //var data =
                        // alert(thisForm.find(".result-list").html());
                        // alert(thisForm.attr("data-target"));
                        // alert($(".result-list[data-target='" + thisForm.attr("data-target") + "']").html());
                        $(".result-list[data-target='" + thisForm.attr("data-target") + "']").html(data.html);
                        //$(".result-list").html(data.referencesAccordionHtml);

                        // $(".keywords-list").html(data.keywordsHtml);
                        thisForm.removeClass("disabled");
                        hide($(".loading-components"));

                        // hide($(".loading-components"));
                        addEvents();
                    }, function (data) {
                        alert(JSON.stringify(data));
                        thisForm.removeClass("disabled");
                        // hide($(".loading-components"));
                    });
                }
            });
        });

        $(".link-execute-task").click(function (index) {
            var thisElt = $(this);
            var form = $(".form-grammarPro");
            var llmTask = thisElt.attr("data-task");
            var additionalParams = thisElt.attr("data-params");
            form.attr("data-task", llmTask);
            form.attr("data-params", additionalParams);
            form.submit();
            $(".link-execute-task").removeClass("active");
            thisElt.addClass("active");
            //alert(thisForm.html());
            //alert("#" + thisForm.attr("id"));

        });

        /*  $("input[name='citation-exportation-type']").change(function (e) {
             var thisElt = $(this);
             var value = thisElt.val();
             var citation = "";
             var checkBoxWasSelected = false;
             //alert(value);
             $(".reference-checkbox").each(function (index) {
                 var thisCheckBox = $(this);
                 //alert(index);
                 if (thisCheckBox.prop("checked")) {
                     //alert(index);
                     citation += $(".bibliography-item-" + value).eq(index).html() + "\n\n";
                     checkBoxWasSelected = true;
                     //alert(citation);
                 }
 
             });
             if (checkBoxWasSelected) {
                 //alert(checkBoxWasSelected);
                 $("#citation-modal").modal("show");
                 //return;
             } else {
 
             }
             //alert(citation);
             $(".citation-exportation-preview").val(citation);
 
         });
 
         $(".btn-citation-modal").click(function (index) {
             //alert("ok");
             $("input[name='citation-exportation-type']:eq(0)").trigger("change");
         }); */





        $('.filepond').each(function (index) {
            FilePond.setOptions({
                server: {
                    url: $(this).attr("data-url"),
                    /* process: '/process',
                    revert: '/process',
                    patch: "?patch=", */
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        // 'X-CSRF-TOKEN': $(this).attr("data-csrf-token")
                        // 'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }

                }
            });
            $(this).filepond();

        });


        /* $('.tiny-wysiwyg').tinymce({
            height: 500,
            menubar: false,
            plugins: [
              'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
              'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
              'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic backcolor | ' +
              'alignleft aligncenter alignright alignjustify | ' +
              'bullist numlist outdent indent | removeformat | help'
          }); */

    });


    /*  if ($(".markdown")) {
         alert("yes");
         var markdown = new showdown.Converter();
     text      = $(".markdown-text").html();
     alert(text);
     // text      = '# hello, markdown!';
     // text = "# CDN Block \n code fences ``` Sample text here... ``` Syntax highlighting ``` js var foo = function (bar) {```"
     html      = markdown.makeHtml(text);
     $(".markdown-output").html(html)
         alert(html);
 
     } */

    function addEvents(params) {

        // alert("re");
        // if ($(".diff-container")) {

        // }

        /* var quill = new Quill('.editor-wysiwyg', {
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Compose an epic...',
            theme: 'snow'  // or 'bubble'
        }); */

        $(".diff-container").prettyTextDiff({
            cleanup: true,
            // originalContent: "Some text here.",
            // changedContent: "Some more text which can be passed to this function.",
            diffContainer: ".diff",
            // debug:true

        });
        $('.translation-lang-list').select2();
        // Set the default value
        $('.translation-lang-list').val($('.translation-lang-list').attr("value")).trigger('change');
        // Bind an event
        $('.translation-lang-list').on('select2:select', function (e) {
            var linkToGoElt = $(".link-execute-task-manuscript-translation");
            linkToGoElt.attr("data-params", $(this).attr("data-param-name") + "=" + $(this).val());
            linkToGoElt.trigger("click");
        });
    }

});
//