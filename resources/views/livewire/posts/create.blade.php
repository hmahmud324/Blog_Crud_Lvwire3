<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form wire:submit="store" enctype="multipart/form-data">
                        <div class="form-group mb-4">
                            <label>Image</label>
                            <input type="file" class="form-control" wire:model="image">
                            @error("image")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label>Title</label>
                            <input type="text" class="form-control" wire:model="title" >

                            @error("title")
                           <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label>Content</label>
                            <textarea class="form-control" wire:model="content" ></textarea>
                            @error("content")
                           <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-md btn-success">CREATE</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>