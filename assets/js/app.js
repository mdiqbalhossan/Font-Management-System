$(document).ready(function () {
    // Handle font upload
    $("#fontUpload").on("change", function () {
        let formData = new FormData();
        formData.append("font", this.files[0]);

        $.ajax({
            url: BASE_URL + 'upload-font',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                let res = JSON.parse(response);
                if (res.success) {
                    loadFonts();
                    showAlert("Font uploaded successfully!", 'success');
                } else {
                    showAlert(res.message, 'error');
                }
            }
        });
    });

    // Load uploaded fonts
    function loadFonts() {
        $.ajax({
            url: BASE_URL + 'fonts/',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                data = JSON.parse(data);
                let html = "";
                html += `<thead>
                        <tr>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                FONT NAME
                            </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                PREVIEW
                            </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                
                            </th>
                        </tr>
                        </thead><tbody>`

                data.forEach(function (font) {
                    injectCss(font);
                    html += `<tr>
                            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-md whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                ${font.name}
                            </th>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-md whitespace-nowrap p-4 ">
                                <p class="${font.name}">Example Style</p>
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-md whitespace-nowrap p-4" id="deleteFont" data-url="${font.url}">
                                <a href="javascript:void(0)" class="text-red-500">Delete</a>
                            </td>                            
                        </tr>`;
                });
                html += "</tbody>";
                $("#fontList").html(html);

            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    /**
     * Injects the font into the page
     * @param {Object} font
     */
    function injectCss(font) {
        let fontName = font.name;
        let fontPath = font.url;

        let fontFace = `@font-face {
            font-family: '${fontName}';
            src: url('${fontPath}');
        }`;

        let style = `.${fontName} {
            font-family: '${fontName}', sans-serif;
        }`;

        let css = `${fontFace} ${style}`;

        let styleTag = document.createElement('style');
        styleTag.type = 'text/css';
        styleTag.appendChild(document.createTextNode(css));
        document.head.appendChild(styleTag);
    }

    /**
     * Delete Font
     */
    $(document).on("click", "#deleteFont", function () {
        let fontUrl = $(this).data("url");
        if (!confirm("Are you sure you want to delete this font?")) {
            return;
        } else {
            $.ajax({
                url: BASE_URL + 'delete-font',
                method: 'POST',
                data: {fontUrl: fontUrl},
                success: function (response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        loadFonts();
                        showAlert("Font deleted successfully!", 'success');
                    } else {
                        showAlert(res.message, 'error');
                    }
                }
            });
        }
    })

    // Handle font group creation
    $("#createGroupSubmit").on("click", function (e) {
        alert("Hello");
        e.preventDefault();
        let groupName = $("#groupName").val();
        let selectedFonts = [];
        let fontNames = [];
        $(".font-select").each(function () {
            if ($(this).val() != "") {
                selectedFonts.push($(this).val());
            }
        });

        $(".font_name").each(function () {
            if ($(this).val() != "") {
                fontNames.push($(this).val());
            }
        })

        if (selectedFonts.length < 2) {
            alert("Please select at least two fonts.");
            return;
        }

        $.ajax({
            url: BASE_URL + 'create-group',
            type: 'POST',
            data: {groupName: groupName, fonts: selectedFonts, name: fontNames},
            success: function (response) {
                let res = JSON.parse(response);
                if (res.success) {
                    loadFontGroups();
                    showAlert("Font group created successfully!", 'success');
                } else {
                    showAlert(res.message, 'error');
                }
            }
        });
    });

    // Load font groups
    function loadFontGroups() {
        $.ajax({
            url: BASE_URL + 'groups',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                let html = "";
                html += `<thead>
                        <tr>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                GROUP NAME
                            </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                FONTS
                            </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                COUNT
                            </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                
                            </th>
                        </tr>
                        </thead><tbody>`

                data.forEach(function (group) {
                    html += `<tr>
                            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-md whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                ${group.name}
                            </th>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-md whitespace-nowrap p-4 ">
                                ${group.fontsName.join(", ")}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-md whitespace-nowrap p-4 ">
                                ${group.fonts.length}
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-md whitespace-nowrap p-4">
                                <a href="javascript:void(0)" class="text-blue-500 mr-2" id="editGroup" data-id="${group.id}">Edit</a>
                                <a href="javascript:void(0)" class="text-red-500" id="deleteGroup" data-id="${group.id}">Delete</a>
                            </td>                            
                        </tr>`;
                });
                html += "</tbody>";
                $("#fontListGroup").html(html);

            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    // Initial Load
    loadFonts();
    loadFontGroups();

    //handle Add Row Button
    $(document).on("click", "#addRow", function () {
        let html = `<div class="flex items-center row_form_group">
                        <div class="w-2/5 px-2">
                            <div class="mb-3">
                                <input type="text" name="font_name[]" placeholder="Font Name" class="font_name mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200 focus:border-blue-400">
                            </div>
                        </div>
                        <div class="w-2/5 px-2">
                            <div class="mb-3">
                                <select name="font[]" class="font-select select selectFont mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200 focus:border-blue-400">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="w-1/5 px-2">
                            <div class="mb-3 flex justify-center items-center">
                                <button id="deleteRow"
                                        class="text-red-600"
                                        type="button" style="transition: all 0.15s ease 0s;">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>`;
        $("#form-group-append").append(html);
        loadFontsSelect();
    })

    //Handle Delete Row
    $(document).on("click", "#deleteRow", function () {
        $(this).closest(".row_form_group").fadeOut(400, function () {
            $(this).remove();
        });
    });

    //Handle Click Create Group
    $(document).on("click", "#createGroup", function () {
        $("#fontUploadForm").hide();
        $("#fontListTable").hide();
        $("#fontGroupCreation").show();
        $("#formGroupListTable").show();
    });

    //Handle Uplaod fonts button
    $(document).on("click", "#uploadFonts", function () {
        $("#fontUploadForm").show();
        $("#fontListTable").show();
        $("#fontGroupCreation").hide();
        $("#formGroupListTable").hide();
    });
    loadFontsSelect();

    //load fonts with select option
    function loadFontsSelect() {
        $.ajax({
            url: BASE_URL + 'fonts/',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                data = JSON.parse(data);
                let html = "";
                data.forEach(function (font) {
                    html += `<option value="${font.name}">${font.name}</option>`;
                });
                $(".selectFont").html(html);
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    //Edit Font Group
    $(document).on("click", "#editGroup", function () {
        let groupId = $(this).data("id");
        $.ajax({
            url: BASE_URL + 'edit-group',
            method: 'POST',
            data: {groupId: groupId},
            success: function (response) {
                response = JSON.parse(response);
                $("#groupName").val(response.name);
                $("#createGroupSubmit").addClass('hidden');
                $("#updateGroupSubmit").removeClass('hidden');
                $("#updateGroupSubmit").attr("data-id", groupId);
                let fonts = response.fonts;
                let fontNames = response.fontsName;
                let html = "";

                for (let i = 0; i < fonts.length; i++) {
                    html += `<div class="flex items-center row_form_group">
                                    <div class="w-2/5 px-2">
                                        <div class="mb-3">
                                            <input type="text" name="font_name[]" value="${fontNames[i]}" placeholder="Font Name" class="font_name mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200 focus:border-blue-400">
                                        </div>
                                    </div>
                                    <div class="w-2/5 px-2">
                                        <div class="mb-3">
                                            <select name="font[]" class="font-select select selectFont mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200 focus:border-blue-400">
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="w-1/5 px-2">
                                        <div class="mb-3 flex justify-center items-center">
                                            <button id="deleteRow"
                                                    class="text-red-600"
                                                    type="button" style="transition: all 0.15s ease 0s;">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>`;
                }
                $("#form-group-append").html(html);
                loadFontsSelect();

                setTimeout(function () {
                    $(".font-select").each(function (index) {
                        $(this).val(fonts[index]);
                    });
                }, 500);
            }
        });
    });

    //Update Group Font
    $(document).on("click", "#updateGroupSubmit", function () {
        let groupName = $("#groupName").val();
        let selectedFonts = [];
        let fontNames = [];
        $(".font-select").each(function () {
            if ($(this).val() != "") {
                selectedFonts.push($(this).val());
            }
        });

        $(".font_name").each(function () {
            if ($(this).val() != "") {
                fontNames.push($(this).val());
            }
        })

        if (selectedFonts.length < 2) {
            alert("Please select at least two fonts.");
            return;
        }

        let groupId = $(this).data("id");
        $.ajax({
            url: BASE_URL + 'update-group',
            type: 'POST',
            data: {groupId: groupId, groupName: groupName, fonts: selectedFonts, name: fontNames},
            success: function (response) {
                let res = JSON.parse(response);
                console.log(res);
                if (res.success) {
                    loadFontGroups();
                    $(".updateGroup").html("Create Group");
                    $(".updateGroup").removeClass("updateGroup");
                    $(".updateGroup").removeAttr("data-id");
                    $(".updateGroup").attr("id", "createGroupSubmit");
                    $("#groupName").val("");
                    $("#form-group-append").html("");
                    showAlert("Font group updated successfully!", 'success');
                } else {
                    showAlert(res.message, 'error');
                }
            }
        });
    });

    //Delete Group
    $(document).on("click", "#deleteGroup", function () {
        let groupId = $(this).data("id");
        if (!confirm("Are you sure you want to delete this group?")) {
            return;
        } else {
            $.ajax({
                url: BASE_URL + 'delete-group',
                method: 'POST',
                data: {groupId: groupId},
                success: function (response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        loadFontGroups();
                        showAlert("Font group deleted successfully!", 'success');
                    } else {
                        showAlert(res.message, 'error');
                    }
                }
            });
        }
    })

    //Function show alert message
    function showAlert(message, type) {
        let className = '';
        if(type === 'success'){
            className = 'bg-green-100 border-t-4 border-green-500 rounded-b text-teal-900 px-4 py-3 shadow-md';
        }else{
            className = 'bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md';
        }
        let alert = `<div class="${className}" role="alert">
          <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
              <p class="font-bold">${message}</p>
            </div>
          </div>
        </div>`;
        //show and hide after 5 seconds
        $("#alert").html(alert);
        setTimeout(function () {
            $("#alert").html("");
        }, 5000);
    }

});
