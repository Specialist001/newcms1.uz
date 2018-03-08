<?php $this->theme->header(); ?>

    <main>
        <div class="container">
            <div class="col">
                <h3>Create Page</h3>
                <form>
                    <div class="form-group">
                        <label for="formTitle">Title</label>
                        <input type="text" class="form-control" id="formTitle" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="formContent">Content</label>
                        <textarea class="form-control" id="formContent"></textarea>

                    </div>
                </form>
            </div>

        </div>
    </main>

<?php $this->theme->footer(); ?>