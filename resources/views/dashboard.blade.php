@extends('layouts.app')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Movies Dashboard</h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#createModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Insert new Movie
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#createModal" aria-label="Create new report">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Movies</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <div class="text-secondary">
                                Show
                                <div class="mx-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
                                </div>
                                entries
                            </div>
                            <div class="ms-auto text-secondary">
                                Search:
                                <div class="ms-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="moviesTable" class="table card-table table-vcenter">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Title</th>
                                    <th>Year</th>
                                    <th>Available</th>
                                    <th>Genre</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movies as $movie)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $movie->title }}</td>
                                    <td>{{ $movie->year }}</td>
                                    <td>{{ $movie->available ? 'Available' : 'Not Available' }}</td>
                                    <td>{{ $movie->genre->name }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $movie->id }}">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $movie->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-secondary">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
                        <ul class="pagination m-0 ms-auto">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M15 6l-6 6l6 6" />
                                    </svg>
                                    prev
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    next
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 6l6 6l-6 6" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal modal-blur fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Movie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('dashboard.movie.insert') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Movie title" required />
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Genre of the Movie</label>
                                <select class="form-select" name="genre" required>
                                    @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Year of Movie</label>
                                <input type="number" maxlength="4" min="4" class="form-control" name="year" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Movie poster</label>
                            <input class="form-control" type="file" accept="image/*" rows="3" name="poster" required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Synopsis</label>
                            <textarea class="form-control" rows="3" name="synopsis" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Is Available?</label>
                            <select class="form-select" name="available" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</a>
                        <button class="btn btn-primary ms-auto" type="submit">Insert</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal modal-blur fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Edit Movie</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form method="POST" action="{{ route('dashboard.movie.update', ['id' => '__ID__']) }}" enctype="multipart/form-data" id="editForm">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="id" id="editMovieId">
                  <div class="mb-3">
                      <label class="form-label">Title</label>
                      <input type="text" class="form-control" name="title" id="editTitle" placeholder="Movie title" required />
                  </div>
                  <div class="row">
                      <div class="col-lg-6">
                          <div class="mb-3">
                              <label class="form-label">Genre of the Movie</label>
                              <select class="form-select" name="genre" id="editGenre" required>
                                  @foreach($genres as $genre)
                                  <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="mb-3">
                              <label class="form-label">Year of Movie</label>
                              <input type="number" maxlength="4" min="4" class="form-control" name="year" id="editYear" required />
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-12">
                      <div class="mb-3">
                          <label class="form-label">Movie poster</label>
                          <input class="form-control" type="file" accept="image/*" rows="3" name="poster" id="editPoster" />
                          <!-- Image Preview -->
                          <div class="mt-2">
                              <img id="posterPreview" src="#" alt="Poster Preview" style="max-width: 100%; height: auto; display: none;" />
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-12">
                      <div class="mb-3">
                          <label class="form-label">Synopsis</label>
                          <textarea class="form-control" rows="3" name="synopsis" id="editSynopsis" required></textarea>
                      </div>
                  </div>
                  <div class="col-lg-12">
                      <div class="mb-3">
                          <label class="form-label">Is Available?</label>
                          <select class="form-select" name="available" id="editAvailable" required>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                          </select>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</a>
                      <button class="btn btn-primary ms-auto" type="submit">Update</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal modal-blur fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                </svg>
                <h3>Are you sure?</h3>
                <div class="text-secondary">Do you really want to delete this movie? This action cannot be undone.</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        <div class="col">
                            <form id="deleteForm" method="POST" action="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('editPoster').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('posterPreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
      });

        document.querySelectorAll('[data-bs-target="#editModal"]').forEach(button => {
          button.addEventListener('click', function () {
              const movieId = this.getAttribute('data-id');

              fetch(`/dashboard/movie/${movieId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('editMovieId').value = data.id;
                        document.getElementById('editTitle').value = data.title;
                        document.getElementById('editGenre').value = data.genre_id;
                        document.getElementById('editYear').value = data.year;
                        document.getElementById('editSynopsis').value = data.synopsis;
                        document.getElementById('editAvailable').value = data.available ? '1' : '0';

                        const posterPreview = document.getElementById('posterPreview');
                        if (data.poster) {
                            posterPreview.src = "{{ asset('storage/') }}/" + data.poster;
                            posterPreview.style.display = 'block';
                        } else {
                            posterPreview.style.display = 'none';
                        }

                        document.getElementById('editForm').action = `/dashboard/movie/${data.id}`;
                    })
                  .catch(error => console.error('Error fetching movie data:', error));
            });
        });

        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const movieId = button.getAttribute('data-id');

            const form = document.getElementById('deleteForm');
            form.action = `/dashboard/movie/${movieId}`;
        });
        
    });
</script>

@endsection