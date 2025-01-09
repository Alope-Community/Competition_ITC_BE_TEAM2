<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
</head>

<body class="bg-taskia-background-grey text-taskia-black font-poppins">
    <div class="container min-h-screen mx-auto flex justify-center items-center">
        <div id="LoginForm" class="flex flex-col bg-white rounded-[30px] gap-[30px] p-[50px] max-w-[500px] w-full">
            <div class="flex justify-center">
                <h1 class="font-bold text-[22px] leading-[33px] mb-[3px]">CREATE ACCOUNT ADMIN</h1>
            </div>
            <div class="flex flex-col gap-5">
                <hr class="text-taskia-background-grey">
                <form class="flex flex-col gap-[30px]" id="userForm">
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
                    <a href="{{ route('auth.index') }}" class="flex gap-[10px] justify-center items-center text-indigo-950 p-[12px_16px] h-12 font-semibold rounded-full w-full border border-taskia-background-grey">
                        Login</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>