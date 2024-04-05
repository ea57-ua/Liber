var likeButtons = document.querySelectorAll('.like-button');
likeButtons.forEach(function (button) {
    button.addEventListener('click', function () {
        var postId = this.getAttribute('data-post-id');
        fetch('/forum/' + postId + '/like', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.liked) {
                    this.classList.remove('bi-heart');
                    this.classList.add('bi-heart-fill', 'liked');
                } else {
                    this.classList.remove('bi-heart-fill', 'liked');
                    this.classList.add('bi-heart');
                }

                var likesCountElement = document.querySelector('.likes-count[data-post-id="' + postId + '"]');
                if (likesCountElement) {
                    var currentLikesCount = parseInt(likesCountElement.textContent) || 0;
                    if (data.liked) {
                        likesCountElement.textContent = currentLikesCount + 1;
                    } else {
                        likesCountElement.textContent = currentLikesCount > 1 ? currentLikesCount - 1 : '';
                    }
                }
            });
    });
});
