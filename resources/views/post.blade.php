<x-layout>
    <article id="postArticle">
        <h1>{{ $post->title }}</h1>

        <p>
            by <a href="#">{{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
        </p>

        <div>
            {!! $post->body !!}
        </div>
    </article>

    <a href="/">Go Back</a>
</x-layout>