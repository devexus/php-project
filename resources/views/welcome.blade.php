<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Company events</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    @vite(['resources/css/app.css'])

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>




    <style>
        * {
            box-sizing: border-box;
        }

        /* Set a background color */
        body {
            background-color: #e2e2e2;
            font-family: Helvetica, sans-serif;
        }

        /* The actual timeline (the vertical ruler) */
        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 20px;
        }

        /* The actual timeline (the vertical ruler) */
        .timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: white;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }

        /* Container around content */
        .container {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }

        /* The circles on the timeline */
        .container::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            right: -13px;
            background-color: white;
            border: 4px solid #FF9F55;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }

        /* Place the container to the left */
        .left {
            left: 0;
        }

        /* Place the container to the right */
        .right {
            left: 50%;
        }

        /* Add arrows to the left container (pointing right) */
        .left::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            right: 30px;
            border: medium solid white;
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent white;
        }

        /* Add arrows to the right container (pointing left) */
        .right::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            left: 30px;
            border: medium solid white;
            border-width: 10px 10px 10px 0;
            border-color: transparent white transparent transparent;
        }

        /* Fix the circle for containers on the right side */
        .right::after {
            left: -13px;
        }

        /* The actual content */
        .content {
            padding: 20px 30px;
            background-color: white;
            position: relative;
            border-radius: 6px;
        }

        /* Media queries - Responsive timeline on screens less than 600px wide */
        @media screen and (max-width: 600px) {

            /* Place the timelime to the left */
            .timeline::after {
                left: 31px;
            }

            /* Full-width containers */
            .container {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            /* Make sure that all arrows are pointing leftwards */
            .container::before {
                left: 60px;
                border: medium solid white;
                border-width: 10px 10px 10px 0;
                border-color: transparent white transparent transparent;
            }

            /* Make sure all circles are at the same spot */
            .left::after,
            .right::after {
                left: 15px;
            }

            /* Make all right containers behave like the left ones */
            .right {
                left: 0%;
            }
        }

        #modalOverlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 9999;


        }

        #modal {
            position: fixed;
            width: 90%;
            top: 55%;
            left: 50%;
            text-align: center;
            background-color: #fafafa;
            box-sizing: border-box;
            opacity: 0;
            transform: translate(-50%, -50%);
            transition: all 300ms ease-in-out;

        }

        #modalOverlay.modal-open #modal {
            opacity: 1;
            top: 50%;
        }

        @media print {
            #printPage {
                display: none;
            }
        }
    </style>

</head>

<body class="antialiased">
    <div class="flex items-center justify-center h-48 bg-slate-800">
        <span class="text-6xl text-center text-white">Company events</span>
    </div>
    <div class="timeline">
        @foreach($events as $index=>$event)
        <div class="container {{ $index % 2 == 0 ? 'left' : 'right' }}">
            <div class="content rounded shadow">
                <div class="overflow-hidden modal-trigger cursor-pointer" data-target="{{$event->id}}">

                    <div class="px-2 py-2">
                        <div class="font-bold text-xl mb-2">{{$event->name}}</div>
                        <div class="pt-4 pb-4">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2" style="background-color: {{$event->category->color}};">{{$event->category->name}}</span>
                        </div>
                        <div class="flex items-center justify-between relative">
                            <div class="flex flex-col z-10  items-center gap-2 ">
                                <div class="text-green-400 font-bold">
                                    {{__('START DATE')}}
                                </div>
                                <div class="flex shadow-md flex-col rounded-md overflow-hidden bg-white">
                                    <div class="bg-green-400 h-3 w-full"></div>
                                    <div class="flex flex-col justify-center px-4">
                                        <div class="text-center text-3xl py-3">{{date("d", strtotime($event->date_start))}}</div>
                                        <div class="text-center">{{date("M", strtotime($event->date_start))}}</div>
                                        <div class="text-center">{{date("Y", strtotime($event->date_start))}}</div>
                                    </div>

                                </div>
                            </div>
                            <div class="flex flex-col  z-10 items-center gap-2">
                                <div class="text-red-400 font-bold">
                                    {{__('END DATE')}}
                                </div>
                                <div class="flex shadow-md flex-col rounded-md overflow-hidden bg-white">
                                    <div class="bg-red-400 h-3 w-full"></div>
                                    <div class="flex flex-col justify-center px-4">
                                        <div class="text-center text-3xl py-3">{{date("d", strtotime($event->date_end))}}</div>
                                        <div class="text-center">{{date("M", strtotime($event->date_end))}}</div>
                                        <div class="text-center">{{date("Y", strtotime($event->date_end))}}</div>
                                    </div>

                                </div>
                            </div>
                            <div class="flex-1 h-16 absolute z-0 w-full" style="background: linear-gradient(90deg, #4ade8026, white, #f8717180);"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
        <div id="modalOverlay" style="display:none;">
            <div id="modal" class="rounded-2xl max-w-2xl">
                <div class="flex py-2 w-full items-center justify-center border-b">
                    <h1 id="modalTitle" class="pt-4 text-xl text-black font-semibold text-center pb-4"></h1>
                    <button id="close" class="m-4 absolute top-0 right-1 hover:bg-gray-200 rounded-full p-1 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-black" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="px-12 py-2 overflow-auto" style="max-height: 500px;">
                    <div class="flex flex-col mb-2">
                        <div>
                            <img id="modalImage" class="w-full" alt="Sunset in the mountains">
                            <div class="flex justify-start pt-3">
                                <span id="modalCategoryName" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"></span>
                            </div>
                            <div class="flex items-center mt-3 justify-between relative">
                                <div class="flex flex-col z-10  items-center gap-2 ">
                                    <div class="text-green-400 font-bold">
                                        {{__('START DATE')}}
                                    </div>
                                    <div class="flex shadow-md flex-col rounded-md overflow-hidden bg-white">
                                        <div class="bg-green-400 h-3 w-full"></div>
                                        <div class="flex flex-col justify-center px-4">
                                            <div id="modalDateStartDay" class="text-center text-3xl py-3"></div>
                                            <div id="modalDateStartMonth" class="text-center"></div>
                                            <div id="modalDateStartYear" class="text-center"></div>
                                        </div>

                                    </div>
                                </div>
                                <div class="flex flex-col  z-10 items-center gap-2">
                                    <div class="text-red-400 font-bold">
                                        {{__('END DATE')}}
                                    </div>
                                    <div class="flex shadow-md flex-col rounded-md overflow-hidden bg-white">
                                        <div class="bg-red-400 h-3 w-full"></div>
                                        <div class="flex flex-col justify-center px-4">
                                            <div id="modalDateEndDay" class="text-center text-3xl py-3"></div>
                                            <div id="modalDateEndMonth" class="text-center"></div>
                                            <div id="modalDateEndYear" class="text-center"></div>
                                        </div>

                                    </div>
                                </div>
                                <div class="flex-1 h-16 absolute z-0 w-full" style="background: linear-gradient(90deg, #4ade8026, white, #f8717180);"></div>
                            </div>
                            <div id="modalDescription" class="text-justify py-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-primary-button class="fixed right-3 bottom-3 .print-button" id="printPage">{{ __('Print screen') }}</x-primary-button>
    <script>
        const events = @json($events);
        console.log('event', events)


        const modal = $('#modal');


        $('.modal-trigger').click(function(event) {
            const target = $(this).data("target");


            const data = events.find(el => el.id === target);

            $('#modalTitle').html(data.name)
            const categoryName = $('#modalCategoryName')
            categoryName.html(data.category.name)
            categoryName.css('background-color', data.category.color);

            $('#modalImage').attr('src', data.image_url);
            $('#modalOverlay').show().addClass('modal-open');
            $('#modalDescription').html(data.description);

            const date_start = new Date(data.date_start);

            $('#modalDateStartDay').html(date_start.getDate())

            const monthNameStart = date_start.toLocaleString('default', {
                month: 'long'
            });
            $('#modalDateStartMonth').html(monthNameStart)
            $('#modalDateStartYear').html(date_start.getFullYear())

            const date_end = new Date(data.date_end);
            console.log('date', date_end.getDay())
            $('#modalDateEndDay').html(date_end.getDate())

            const monthNameEnd = date_start.toLocaleString('default', {
                month: 'long'
            });
            $('#modalDateEndMonth').html(monthNameEnd)
            $('#modalDateEndYear').html(date_start.getFullYear())
        });

        $('#close').click(function() {
            var modal = $('#modalOverlay');
            modal.removeClass('modal-open');
            setTimeout(function() {
                modal.hide();
            }, 200);
        });

        $('#printPage').click(function() {
            window.print();
        })
    </script>
</body>

</html>