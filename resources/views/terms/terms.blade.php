 <div class="terms-wrapper w-100 h-100 mx-auto" style="color:#bbb;">
        
        <div class="my-4">
           <h1 class="text-center">Terms of Use</h1>
            <p>Thank you for using A-Star Academy. Please read the following terms, conditions carefully.</p>
    
            <p>By agreeing on our Copyright and Trademark Policy, you are confirming that has been notified not to share,
                or distribute any of our courses, services and/or materials without written permission issued by A-Star
                Academy administration. That includes
                &NewLine;
                (a) Sharing our videos, courses, services, materials and anything published on our website with other
                parties;&NewLine;
                (b) Selling, renting or making profit using any of our resources;&NewLine;
                (c) Use any of our resources in any form outside our only website “astaracademy.net”&NewLine;
                Violating any of the above terms, policies will make you responsible and A-Star Academy has all rights to
                legally sue you.</p> 
        </div>
        <div class="my-5">
            @if (count($terms))
            @foreach($terms as $term)
                @if ($term->display)
                <div class="my-3">
                    <h4> {{ $term->title }} </h4>
                    <p> {{ $term->text }} </p>
                </div>
                @endif
            
            @endforeach
            @endif
            
        </div>
        
    </div>