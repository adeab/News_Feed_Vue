<template>
    <div>
        <h2>Feeds</h2>
        <form @submit.prevent="addFeed">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" v-model="feed.title">
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="body" v-model="feed.body"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>

        </form>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchFeeds(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]"  class="page-item"><a class="page-link" href="#" @click="fetchFeeds(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
        <div class="card card-body" v-for="feed in feeds" v-bind:key="feed.id">
            <h3>{{feed.title}}</h3>
            <p>{{feed.body}}</p>
            <hr>
            <button @click="deleteFeed(feed.id)" class="btn btn-danger">Delete</button>
            <button @click="editFeed(feed)" class="btn btn-success">Edit</button>
        </div>
    </div>    
</template>

<script>
export default {
data(){
    return {
        feeds: [],
        feed: {
            id: '',
            title: '',
            body: '',
            link: ''
        },
        feed_id: '',
        pagination: {},
        edit: false

    }
},
created(){
    this.fetchFeeds();
},
methods:{
    fetchFeeds(page_url){
        let vm = this;
        page_url= page_url ||'feeds/api'
        fetch(page_url)
        .then(res => res.json())
        .then(res =>{
            this.feeds = res.data;
            vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links){
        let pagination= {
            current_page: meta.current_page,
            last_page: meta.last_page,
            next_page_url: links.next,
            prev_page_url: links.prev
        }
        this.pagination = pagination;

    },
    deleteFeed(id){
        if (confirm('Are you sure you want to delete?')){
            fetch(`api/feed/${id}`, {
                method: 'delete'
            })
            .then(res => res.json())
            .then(data=> {
                alert('Article Removed');
                this.fetchFeeds();
            })
            .catch(err => console.log(err));
        }
    },
    addFeed(){
        if(this.edit === false){
            //ADD
            fetch('api/feed', {
                method: 'post',
                body: JSON.stringify(this.feed),
                headers: {
                    'content-type': 'application/json'
                }
            })
            .then(res => res.json())
            .then( data=> {
                this.feed.title = '';
                this.feed.body = '';
                alert('Feed Added');
                this.fetchFeeds();
            })
        }
        else{
            //Update
            fetch('api/feed', {
                method: 'put',
                body: JSON.stringify(this.feed),
                headers: {
                    'content-type': 'application/json'
                }
            })
            .then(res => res.json())
            .then( data=> {
                this.feed.title = '';
                this.feed.body = '';
                alert('Feed Updated');
                this.fetchFeeds();
            })
        }
        
    },
    editFeed(feed){
        this.edit= true;
        this.feed.id= feed.id;
        this.feed.feed_id=feed.id;
        this.feed.title=feed.title;
        this.feed.body=feed.body;

    }
  }
}
</script>

<style>

</style>
