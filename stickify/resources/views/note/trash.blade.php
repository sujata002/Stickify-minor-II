<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trash - Stickify</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/mynotes.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="container">

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div class="logo">
        <p>STICKIFY</p>
      </div>
      <nav>
        <a href="{{ route('dashboard') }}"><i class="fa-solid fa-bars"></i> Dashboard</a>
        <a href="{{ route('mynotes') }}"><i class="fa-solid fa-note-sticky"></i> My Notes</a>
        <a href="#"><i class="fa-solid fa-bookmark"></i> Bookmarks</a>
        <a href="#"><i class="fa-solid fa-folder-plus"></i> Categories</a>
        <a href="{{ route('mynotes.trash') }}" class="active"><i class="fa-solid fa-trash"></i> Trash</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <div class="notes-container">
        <div class="note-header">
          <h2>Trash</h2>
        </div>

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($notes->count() > 0)
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Note</th>
              <th colspan="2" style="text-align:center;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($notes as $note)
              <tr>
                <td>{{ $note->title }}</td>
                <td>{{ $note->note_text }}</td>
                <td>
                  <form action="{{ route('mynotes.restore', $note->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-restore"><i class="fa-solid fa-rotate-left"></i> Restore</button>
                  </form>
                </td>
                <td>
                  <form action="{{ route('mynotes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Permanently delete this note?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete"><i class="fa-solid fa-trash-can"></i> Delete Permanently</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        @else
          <p>No notes in trash.</p>
        @endif
      </div>
    </main>
  </div>
</body>
</html>
