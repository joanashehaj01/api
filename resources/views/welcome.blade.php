<div class="container mx-auto">
    <div class="flex justify-center px-6 rounded">
        <div id="app">
            <router-link :to="{ name: 'register'}"></router-link>
            <router-view></router-view>
        </div>
    </div>
</div>

<script src="{{asset('./js/app.js')}}"></script>
