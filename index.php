<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Font Group System</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="p-6">
<div class="container mx-auto">
    <div id="alert" class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto"></div>
    <!-- Font Upload Form -->
    <div id="fontUploadForm">
        <div class="py-10 bg-white px-2">
            <div class="max-w-md mx-auto rounded-lg overflow-hidden md:max-w-lg">
                <div class="md:flex">
                    <div class="w-full p-3">
                        <div class="relative border-dotted h-48 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
                            <div class="absolute">
                                <div class="flex flex-col items-center">
                                    <i class="fa fa-folder-open fa-4x text-blue-700"></i>
                                    <span class="block text-gray-400 font-normal">Click here for upload you fonts</span>
                                </div>
                            </div>
                            <input type="file" id="fontUpload" class="h-full w-full opacity-0" name="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Table Font-->
    <section id="fontListTable" class="py-1 bg-blueGray-50">
        <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-blueGray-700">Our Fonts</h3>
                            <p>
                                A lists of all the fonts that have been uploaded and build your form group
                            </p>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-x-auto">
                    <table class="items-center bg-transparent w-full border-collapse " id="fontList">

                    </table>
                </div>
            </div>

            <!--Create Group Button-->
            <div class="flex flex-wrap mt-4">
                <div class="w-full lg:w-12/12 xl:w-12/12">
                    <button id="createGroup"
                            class="bg-blue-500 text-white active:bg-blue-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1"
                            type="button" style="transition: all 0.15s ease 0s;">
                        Create Group
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- Font Group Creation -->
    <section id="fontGroupCreation" class="hidden py-1 bg-blueGray-50">
        <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-sm rounded ">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-blueGray-700">Create Font Group</h3>
                            <p>
                                You have to select at least two fonts to create a group
                            </p>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-x-auto px-2">
                    <div class="mb-3">
                        <input type="text" name="groupName" id="groupName" placeholder="Group Title" class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200 focus:border-blue-400">
                    </div>
                </div>
                <div class="block w-full overflow-x-auto px-2 shadow-md mt-5" id="form-group-append">
                    <div class="flex items-center row_form_group">
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
                    </div>
                </div>
            </div>

            <!--Create Group Button-->
            <div class="flex flex-wrap mt-4">
                <div class="w-full">
                    <div class="flex justify-between">
                        <button id="addRow"
                                class="bg-blue-500 text-white active:bg-blue-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1"
                                type="button" style="transition: all 0.15s ease 0s;">
                            Add Row
                        </button>
                        <button id="createGroupSubmit"
                                class="bg-green-500 text-white active:bg-green-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1"
                                type="button" style="transition: all 0.15s ease 0s;">
                            Create
                        </button>
                        <button id="updateGroupSubmit"
                                class="hidden bg-green-500 text-white active:bg-green-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1"
                                type="button" style="transition: all 0.15s ease 0s;">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Font Group Table Show-->
    <section id="formGroupListTable" class="hidden py-1 bg-blueGray-50">
        <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-blueGray-700">Our Font Groups</h3>
                            <p>
                                List of All Available Font Groups
                            </p>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-x-auto">
                    <table class="items-center bg-transparent w-full border-collapse" id="fontListGroup">

                    </table>
                </div>
            </div>

            <!--Create Group Button-->
            <div class="flex flex-wrap mt-4">
                <div class="w-full lg:w-12/12 xl:w-12/12">
                    <button id="uploadFonts"
                            class="bg-blue-500 text-white active:bg-blue-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1"
                            type="button" style="transition: all 0.15s ease 0s;">
                        Upload Fonts
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/app.js"></script>
<!-- Inject PHP constant into JavaScript -->
<script>
    const BASE_URL = '<?php echo BASE_URL; ?>';
</script>
</body>
</html>
