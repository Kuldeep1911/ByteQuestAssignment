<!doctype html>
<html lang="en">

<head>
    <title>Laravel CRUD</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container mt-4 mx-auto">
            <div class="row d-flex justify-content-between">
                <div class="col-mb-10">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header">
                            <h3>Laravel CRUD</h3>
                        </div>
                        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="" class="form-label h6">Name:<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Your Name" value="{{old('name')}}">
                                    @error('name') <span class="text-danger">{{ucwords($message)}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label h6">Price: <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
                                        placeholder="Enter Your Price" value="{{old('price')}}">
                                        @error('price') <span class="text-danger">{{ucwords($message)}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label h6">Image: <small class="text-danger">*</small></label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{old('image')}}">
                                    @error('image') <span class="text-danger">{{ucwords($message)}}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label h6">Description: <small class="text-danger">*</small></label>
                                    <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Enter Your Description" cols="40"
                                        rows="3" value="{{old('description')}}">
                                        </textarea>
                                    @error('description') <span class="text-danger">{{ucwords($message)}}</span> @enderror

                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
        < script >
            <
            script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" >
    </script>
</body>

</html>
