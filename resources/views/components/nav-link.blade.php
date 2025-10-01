<div>
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
     <a href="{{ $attributes['href']}}" 
     aria-current="page" 
     class="rounded-md px-3 py-2 text-sm font-medium {{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
     {{ $slot}}</a>
</div>