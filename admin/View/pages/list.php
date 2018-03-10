<?php $this->theme->header(); ?>

    <main>
        <div class="container">
            <h3>Pages <a href="/admin/pages/create/">Creat Page</a> </h3>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <?php foreach ($pages as $page): ?>
                <tr>
                    <th scope="row">1</th>
                    <td><?= $page['title'] ?></td>
                    <td><?= $page['content'] ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

<?php $this->theme->footer(); ?>