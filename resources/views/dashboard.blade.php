<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<title>{{ config('app.name') }}</title>
        
		<!-- Roboto font embed -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">

        <!-- Font awesome -->
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">

		<!-- Stylesheets -->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/reset.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	</head>
	<body>

		<header>
			<form action="{{ url('/item') }}" method="POST">
                @csrf
                <input type="text" placeholder="Enter an activity.." name="item" required>
			    <button id="add">
				    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve"><g><path class="fill" d="M16,8c0,0.5-0.5,1-1,1H9v6c0,0.5-0.5,1-1,1s-1-0.5-1-1V9H1C0.5,9,0,8.5,0,8s0.5-1,1-1h6V1c0-0.5,0.5-1,1-1s1,0.5,1,1v6h6C15.5,7,16,7.5,16,8z"/></g></svg>
			    </button>
            </form>
		</header>

		<div class="container">
			<!-- Tasks to-do -->
			<ul class="todo" id="todo">
                @foreach ($tasks as $task)
                    <li>
                        {{ $task->name }}
                        <form action="{{ route('item.destroy', $task->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <span style="color: gray; margin-right: 15px;">Created at: {{ $task->created_at }}</span>
                            <button class="delete">
                                <i class="fa-light fa-trash-can"></i>
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
		</div>

        <footer>
            <p> Laravel ECS  Made Easy <a href="https://www.Poridhi.io/" target="_blank">Poridhi.io</a></p>
        </footer>
	</body>
</html>