<!--aadded by samira-->
<h2>New Message from Stickify Contact Form</h2>
<p><strong>Name:</strong> {{ $data['name'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Message:</strong><br>{{ $data['message'] }}</p>

@if(session('success'))
  <div class="sticky-success">
    {{ session('success') }}
  </div>
@endif

