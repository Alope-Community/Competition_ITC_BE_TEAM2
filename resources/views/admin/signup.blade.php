<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
</head>

<body class="bg-taskia-background-grey text-taskia-black font-poppins">
    <div class="container min-h-screen mx-auto flex justify-center items-center">
        <div id="LoginForm" class="flex flex-col bg-white rounded-[30px] gap-[30px] p-[50px] max-w-[500px] w-full">
            <div class="flex justify-center">
                <h1 class="font-bold text-[22px] leading-[33px] mb-[3px]">CREATE ACCOUNT KOMUNITAS</h1>
            </div>
            <div class="flex flex-col gap-5">
                <hr class="text-taskia-background-grey">
                <div class="flex flex-col gap-5">
                    <hr class="text-taskia-background-grey">
    
                    <!-- Alert Messages -->
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif
    
                <!-- Error Messages -->
                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <ul class="mt-1 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method='post' class="flex flex-col gap-[30px]" id="userForm" action="register">
                    @csrf
                    <div>
                        <label for="name" class="font-semibold">Nama Lengkap</label>
                        <div
                            class="flex items-center p-[12px_16px] rounded-full border border-taskia-background-grey mt-[6px] focus-within:ring-2 focus-within:ring-taskia-purple">
                            <div class="mr-[10px] w-6 h-6 flex items-center justify-center">
                                <img src="{{ asset('img/icons/profile-circle.svg') }}" alt="icon">
                            </div>
                            <input type="text"
                                class="font-semibold placeholder:text-taskia-grey placeholder:font-normal focus:outline-none w-full "
                                placeholder="Type your full name" id="name" name="name" required>
                        </div>
                    </div>
                    <div>
                        <label for="email" class="font-semibold">email</label>
                        <div
                            class="flex items-center p-[12px_16px] rounded-full border border-taskia-background-grey mt-[6px] focus-within:ring-2 focus-within:ring-taskia-purple">
                            <div class="mr-[10px] w-6 h-6 flex items-center justify-center">
                                <img src="{{ asset('img/icons/email.svg') }}" alt="icon">
                            </div>
                            <input type="text"
                                class="font-semibold placeholder:text-taskia-grey placeholder:font-normal focus:outline-none w-full "
                                placeholder="Type your email" id="email" name="email" required>
                        </div>
                    </div>
                    <div>
                        <label for="password" class="font-semibold">password</label>
                        <div
                            class="flex items-center p-[12px_16px] rounded-full border border-taskia-background-grey mt-[6px] focus-within:ring-2 focus-within:ring-taskia-purple">
                            <div class="mr-[10px] w-6 h-6 flex items-center justify-center">
                                <img src="{{ asset('img/icons/password.svg') }}" alt="icon">
                            </div>
                            <input type="password"
                                class="font-semibold placeholder:text-taskia-grey placeholder:font-normal focus:outline-none w-full "
                                placeholder="Type your password" id="password" name="password" required>
                        </div>
                    </div>
                    <button type="submit"
                        class="flex gap-[10px] justify-center items-center text-white p-[12px_16px] h-12 font-semibold bg-gradient-to-b from-[#977FFF] to-[#6F4FFF] rounded-full w-full border border-taskia-background-grey">
                        Sign Up</button>
                        <hr>
                    <a href="/login" class="flex gap-[10px] justify-center items-center text-indigo-950 p-[12px_16px] h-12 font-semibold rounded-full w-full border border-taskia-background-grey">
                        Sign In</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>