/**
 * Posts — Infinite scroll and post loading.
 *
 * This script fetches posts from the API and appends them to the page
 * as the user scrolls down. The BASE_PATH variable is set by the PHP
 * template so fetch URLs work even in subdirectory deployments.
 */

let currentPage = 1;
let isLoading = false;
let hasMore = true;

/**
 * Fetch the next page of posts from the API and add them to the page.
 */
async function loadPosts() {
    if (isLoading || !hasMore) return;

    isLoading = true;

    try {
        const response = await fetch(BASE_PATH + `/api/posts?page=${currentPage}`);
        const data = await response.json();

        if (!data.success) {
            throw new Error(data.error || 'Failed to load posts');
        }

        if (data.success && data.posts.length > 0) {
            const container = document.getElementById('postsContainer');

            // Remove "Loading posts..." on first load
            if (currentPage === 1) {
                container.innerHTML = '';
            }

            data.posts.forEach(function (post) {
                const postCard = document.createElement('div');
                postCard.className = 'post-card';

                const postDate = new Date(post.created_at);
                const timeAgo = getTimeAgo(postDate);

                postCard.innerHTML =
                    '<div class="post-header">' +
                        '<span class="post-author">' + escapeHtml(post.user_name) + '</span>' +
                        '<span class="post-time">' + timeAgo + '</span>' +
                    '</div>' +
                    '<div class="post-content">' + escapeHtml(post.content) + '</div>';

                container.appendChild(postCard);
            });

            hasMore = data.hasMore;
            currentPage++;

            if (!hasMore) {
                const noMore = document.createElement('div');
                noMore.className = 'no-more';
                noMore.textContent = 'No more posts';
                container.appendChild(noMore);
            }
        } else if (currentPage === 1) {
            document.getElementById('postsContainer').innerHTML =
                '<div class="no-more">No posts yet. Be the first to post!</div>';
        }
    } catch (error) {
        if (currentPage === 1) {
            document.getElementById('postsContainer').innerHTML =
                '<div class="message error">Failed to load posts: ' + error.message + '</div>';
        }
    }

    isLoading = false;
}

/**
 * Escape HTML special characters to prevent XSS.
 */
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

/**
 * Convert a date to a human-readable "time ago" string.
 */
function getTimeAgo(date) {
    const seconds = Math.floor((new Date() - date) / 1000);

    if (seconds < 60) return 'just now';
    if (seconds < 3600) return Math.floor(seconds / 60) + ' minutes ago';
    if (seconds < 86400) return Math.floor(seconds / 3600) + ' hours ago';
    if (seconds < 604800) return Math.floor(seconds / 86400) + ' days ago';

    return date.toLocaleDateString();
}

// --- Infinite scroll: load more posts when near the bottom of the page ---
window.addEventListener('scroll', function () {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 500) {
        loadPosts();
    }
});

// --- Load the first page of posts ---
loadPosts();
