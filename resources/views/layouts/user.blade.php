<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .star-rating {
            display: inline-flex;
            gap: 5px;
            font-size: 1.8rem;
            cursor: pointer;
            color: #ccc;
        }
        .star-rating .star.active {
            color: #ffc107;
        }
    </style>
</head>
<body>
<header class="w-full bg-white shadow p-4 flex justify-between items-center">
    <div class="text-xl font-bold">
        <svg xmlns="http://www.w3.org/2000/svg" width="215.79" height="25" viewBox="0 0 215.79 37.127">
            <g id="Group_48" data-name="Group 48" transform="translate(-578.375 -6374.341)">
                <g id="Group_35" data-name="Group 35" transform="translate(672.722 6385.679)">
                    <g id="Group_33" data-name="Group 33" transform="translate(0 0)">
                        <path id="Path_19" data-name="Path 19" d="M921.12,6432.523a9.04,9.04,0,1,1,9.04-9.04h-2.583a6.457,6.457,0,1,0-6.457,6.457Z" transform="translate(-912.08 -6414.444)" fill="#00a9f3"/>
                    </g>
                    <g id="Group_34" data-name="Group 34" transform="translate(9.04 0)">
                        <path id="Path_20" data-name="Path 20" d="M953.094,6432.523a9.05,9.05,0,0,1-9.04-9.04h2.583a6.457,6.457,0,1,0,6.457-6.457v-2.583a9.04,9.04,0,0,1,0,18.08Z" transform="translate(-944.054 -6414.444)" fill="#00a9f3"/>
                    </g>
                </g>
                <g id="Group_43" data-name="Group 43" transform="translate(710.5 6380.22)">
                    <g id="Group_36" data-name="Group 36" transform="translate(0 5.458)">
                        <path id="Path_21" data-name="Path 21" d="M1054.743,6432.52a9.041,9.041,0,1,1,9.04-9.041A9.051,9.051,0,0,1,1054.743,6432.52Zm0-15.5a6.458,6.458,0,1,0,6.458,6.458A6.465,6.465,0,0,0,1054.743,6417.021Z" transform="translate(-1045.703 -6414.438)" fill="#2a2a69"/>
                    </g>
                    <g id="Group_37" data-name="Group 37" transform="translate(38.728 5.458)">
                        <path id="Path_22" data-name="Path 22" d="M1191.723,6432.52a9.041,9.041,0,1,1,9.04-9.041A9.051,9.051,0,0,1,1191.723,6432.52Zm0-15.5a6.458,6.458,0,1,0,6.457,6.458A6.465,6.465,0,0,0,1191.723,6417.021Z" transform="translate(-1182.683 -6414.438)" fill="#2a2a69"/>
                    </g>
                    <g id="Group_38" data-name="Group 38" transform="translate(59.52 5.458)">
                        <path id="Path_23" data-name="Path 23" d="M1265.267,6432.52a9.041,9.041,0,1,1,9.04-9.041A9.051,9.051,0,0,1,1265.267,6432.52Zm0-15.5a6.458,6.458,0,1,0,6.457,6.458A6.465,6.465,0,0,0,1265.267,6417.021Z" transform="translate(-1256.227 -6414.438)" fill="#2a2a69"/>
                    </g>
                    <g id="Group_39" data-name="Group 39" transform="translate(81.081 0)">
                        <rect id="Rectangle_7" data-name="Rectangle 7" width="2.583" height="23.152" fill="#2a2a69"/>
                    </g>
                    <g id="Group_42" data-name="Group 42" transform="translate(20.084 5.202)">
                        <g id="Group_41" data-name="Group 41">
                            <g id="Group_40" data-name="Group 40">
                                <path id="Path_24" data-name="Path 24" d="M1132.885,6426.7v.031a4.825,4.825,0,0,1-2.8,4.31,10.6,10.6,0,0,1-4.9,1.088,12.779,12.779,0,0,1-8.452-3.041l1.287-2.136c3.031,2.774,7.969,3.458,10.733,1.979a2.831,2.831,0,0,0,1.494-2.19c-.052-1.6-2.04-2.162-5.392-2.776-3.286-.605-7.376-1.36-7.426-5.187a4.631,4.631,0,0,1,2.413-4.04c3-1.81,8.8-1.729,12.683,1.264l-1.288,2.132c-3.086-2.337-7.744-2.763-10.1-1.342a2.429,2.429,0,0,0-1.2,1.967c.02,1.5,2.155,2.058,5.283,2.633C1128.777,6422.048,1132.808,6422.789,1132.885,6426.7Z" transform="translate(-1116.742 -6413.535)" fill="#2a2a69"/>
                            </g>
                        </g>
                    </g>
                </g>
                <g id="Group_47" data-name="Group 47" transform="translate(578.375 6374.341)">
                    <g id="Group_44" data-name="Group 44" transform="translate(78.371 0)">
                        <path id="Path_25" data-name="Path 25" d="M861.933,6381.169h-6.359v-1.847h1.608a4.139,4.139,0,0,1-.793-2.341c0-1.638,1.781-3.271,5.4-2.4l-.267,1.646c-1.968-.732-3.354-.293-3.354,1.117a1.973,1.973,0,0,0,2.206,1.976h1.563Z" transform="translate(-855.574 -6374.34)" fill="#2a2a69"/>
                        <rect id="Rectangle_8" data-name="Rectangle 8" width="2.583" height="19.566" transform="translate(2.733 9.464)" fill="#2a2a69"/>
                    </g>
                    <g id="Group_45" data-name="Group 45" transform="translate(21.838 14.357)">
                        <path id="Path_26" data-name="Path 26" d="M702.768,6425.121c-5.557,0-8.365,5.23-11.081,10.289-.316.59-.642,1.2-.972,1.795-1.312-.257-2.1-1.285-2.1-4.37v-5.282h-2.583v5.282c0,2.742-.492,4.441-2.941,4.441H670.4c0-.083,0-1.538,0-1.538a13.371,13.371,0,0,0-1.584-7.027,6.162,6.162,0,0,0-5.5-3.013,7.581,7.581,0,0,0-5.435,2.279,7.961,7.961,0,0,0-2.268,5.631c0,6.251,5.424,6.251,7.206,6.251h4.837a6.084,6.084,0,0,1-1.862,3.978c-1.734,1.471-4.895,1.84-9.393,1.1l-.421,2.548a27.766,27.766,0,0,0,4.5.41c3.04,0,5.347-.691,6.988-2.084a8.65,8.65,0,0,0,2.8-5.947h12.832a4.431,4.431,0,0,0,4.234-2.274,4.425,4.425,0,0,0,4.231,2.274h19.1v-7.529C710.661,6428.748,707.95,6425.121,702.768,6425.121Zm-34.953,12.155h-4.994c-3.457,0-4.623-.925-4.623-3.668a5.171,5.171,0,0,1,5.119-5.327,3.6,3.6,0,0,1,3.3,1.789,11.092,11.092,0,0,1,1.2,5.668S667.817,6437.194,667.816,6437.276Zm40.262,0H693.617c.116-.216.231-.432.346-.645,2.571-4.79,4.793-8.928,8.805-8.928,3.647,0,5.309,2.4,5.309,4.626Z" transform="translate(-655.615 -6425.121)" fill="#2a2a69"/>
                    </g>
                    <g id="Group_46" data-name="Group 46" transform="translate(0 8.173)">
                        <path id="Path_27" data-name="Path 27" d="M587.142,6431.978a8.848,8.848,0,0,1-6.14-2.371c-1.7-1.633-4.142-5.463-1.374-12.774l2.416.915c-1.662,4.389-1.4,7.939.747,10a6.645,6.645,0,0,0,7.149,1.08,6.517,6.517,0,0,0,3.942-6.332V6403.25h2.583v19.241a9.109,9.109,0,0,1-5.512,8.708A9.729,9.729,0,0,1,587.142,6431.978Z" transform="translate(-578.375 -6403.25)" fill="#2a2a69"/>
                    </g>
                </g>
            </g>
            <script xmlns=""/>
        </svg>
        <span style="font-size: 11px;float: left;position: absolute;top: 40px;color: #4d4d83;left: 107px;">Evaluation</span>
    </div>
    <div class="flex items-center space-x-4">
        <button class="relative">
            <i class="fas fa-bell"></i>
            <span class="absolute top-0 right-0 w-2 h-2 bg-red-600 rounded-full"></span>
        </button>

        <div class="w-8 h-8 bg-gray-300 rounded-full border border-red-500 flex items-center justify-center">
            <i class="fas fa-user"></i>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm ms-3">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        @yield('content')
    </div>
</div>
@stack('scripts')
</body>
</html>
