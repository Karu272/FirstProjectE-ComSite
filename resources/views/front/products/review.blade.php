<div class="review_grids">
    <h5>Add A Review</h5>
    <form action="{{url('/review')}}" method="post">@csrf
        <input type="text" name="name" value="Name" required="">
        <input type="email" name="email" value="Email" required="">
        <input type="text" name="title" value="Title" required="">
        <textarea type="text" name="text" required="">Add Your Review</textarea>
        <input type="submit" value="Submit">
    </form>
</div>