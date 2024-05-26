<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <div class="container mt-2 mx-auto">
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
                <div class="col-md-6 mt-2">
                    <div class="alert alert-success ">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laravel CRUD
                            <button type="button" class="btn btn-dark float-end" data-bs-toggle="modal"
                                data-bs-target="#productAddModal">
                                + Add Product
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Sr.No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>₹{{ $product->price }}</td>
                                        <td><img class="shadow shadow-sm "
                                                src="{{ asset('uploads/products/' . $product->image) }}" alt=""
                                                style="border-radius: 50%; width: 50px; height: 50px;"></td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', [Crypt::encrypt($product->id)]) }}"><button
                                                    class="btn btn-primary">Edit</button></a>
                                            <a href="{{ asset('uploads/products') }}/{{ $product->image }}"
                                                class="btn" target="_blank"> <button
                                                    class="btn btn-secondary">View</button></a>

                                            <a onclick="delet('{{ Crypt::encrypt($product->id) }}')"><button class="btn btn-danger">Delete</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="productAddModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h6">Name:<small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="Enter Your Name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ ucwords($message) }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h6">Price: <small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror"
                                    name="price" placeholder="Enter Your Price" value="{{ old('price') }}">
                                @error('price')
                                    <span class="text-danger">{{ ucwords($message) }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h6">Image: <small
                                        class="text-danger">*</small></label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" value="{{ old('image') }}">
                                @error('image')
                                    <span class="text-danger">{{ ucwords($message) }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h6">Description: <small
                                        class="text-danger">*</small></label>
                                <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description"
                                    placeholder="Enter Your Description" cols="40" rows="3" value="{{ old('description') }}">
                                                </textarea>
                                @error('description')
                                    <span class="text-danger">{{ ucwords($message) }}</span>
                                @enderror

                            </div>
                            <div class="d-grid">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Sweet Alert -->
    <script>
        function delet(id) {

            Swal.fire({
                title: 'Do you want to save the changes?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'YES',
                denyButtonText: `Don't Delete`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('products.delete') }}",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data == "false") {
                                Swal.fire('something went wrong');
                            } else {
                                location.reload();
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 6000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: "Deleted in successfully"
                                });

                            }
                        }

                    });
                }
            });
        }
    </script>
</body>

</html>
