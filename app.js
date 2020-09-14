// const test = (a, b) => console.log(a, b);

// const testApi = () => {
//     fetch('api-test.php', {
//             method: 'post',
//             body: {
//                 bence: 'bence'
//             }
//         })
//         .then(response => response.text())
//         .then(data => console.log(JSON.parse(data)))
// }
// SUBMIT A TWEET 
const submitTweet = () => {
    const data = new FormData(document.querySelector("#formTweet"))
    fetch('api-create-tweet.php', {
            "method": "post",
            "body": data
        })
        .then(response => console.log(response))

}

// GET USER TWEETS

const getUserTweets = async (userId) => {
    // console.log("here comes the tweets");
    return tweetsFromUser = await fetch(`api-get-tweets.php?userId=${userId}`)
        .then(response => response.json())
        .then(data =>
            populateFeedWithTweets(data)
        )
}

const populateFeedWithTweets = (data) => {
    document.querySelector("#feed").innerHTML = '';
    data.forEach(tweet => {
        const tweetNode =
            `
            <li data-postId="${tweet.id}"><h3>${tweet.title}</h3>
            <p>${tweet.message}</p>
            <button onclick="deleteTweet('${tweet.postedBy}','${tweet.id}'); return false;" >Delete</button>
            <button onclick="openTweetUpdateModal('${tweet.postedBy}','${tweet.id}'); return false;" >Update</button>
            </li>
            `
        document.querySelector("#feed").insertAdjacentHTML('afterbegin', tweetNode)
    })
}


// UPDATE TWEET
const openTweetUpdateModal = async (userId, postId) => {

    const postData = await fetch(`api-update-tweet.php?userId=${userId}&postId=${postId}`)
        .then(response => response.json()
            .then(data => {
                return data
            })
        )

    const updateTweetModal = `
    <div class="update-tweet-modal">
        <form id="updateTweetForm">
            <input type="text" placeholder="${postData.title}" name="newTweetTitle">
            <input type="text" placeholder="${postData.message}" name="newTweetMessage">
            <input type="hidden" value="${postData.postedBy}" name="postedBy">
            <input type="hidden" value="${postData.id}" name="tweetId">
            <button onclick="updateTweet(); return false;">Update</button>
        </form>
    </div>
    `
    document.querySelector('#modal').insertAdjacentHTML('afterbegin', updateTweetModal);

}

const updateTweet = async () => {
    const updateTweetData = new FormData(document.querySelector('#updateTweetForm'))
    // console.log(updateTweetData);
    await fetch('api-update-tweet.php', {
            "method": "post",
            "body": updateTweetData
        })
        .then(response => response.text())
        .then(data => console.log(data))
}
// DELETE TWEET
const deleteTweet = (userId, postId) => {
    fetch(`api-delete-tweet.php?userId=${userId}&postId=${postId}`)
        .then(response => response.json()
            .then(data => {
                console.log(data);
            })
        )

}


const deleteTweetModal = `
<div class="delete-tweet-modal">
    <h2>Delete Tweet?</h2>
    <p>This can’t be undone and it will be removed from your profile, the timeline of any accounts that follow you, and from Twitter search results.</p>
    <button class="btn-cancel">Cancel</button>
    <button class="btn-delete">Delete</button>
</div>
`