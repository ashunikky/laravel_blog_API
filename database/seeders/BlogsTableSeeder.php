<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Blog;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get all user IDs to assign to the blogs
        $userIds = User::pluck('id');

        // Define categories, tags, and sample content for seeding
        $categories = ['Technology', 'Travel', 'Food', 'Lifestyle', 'Fashion', 'Health', 'Science', 'Sports','Other'];
        $tags = ['tag1', 'tag2', 'tag3', 'tag4', 'tag5'];
        $sampleContent = 'In publishing and graphic design, Lorem ipsum (/ˌlɔː.rəm ˈɪp.səm/) is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. It is also used to temporarily replace text in a process called greeking, which allows designers to consider the form of a webpage or publication, without the meaning of the text influencing the design.

        Lorem ipsum is typically a corrupted version of De finibus bonorum et malorum, a 1st-century BC text by the Roman statesman and philosopher Cicero, with words altered, added, and removed to make it nonsensical and improper Latin. The first two words themselves are a truncation of dolorem ipsum ("pain itself").
        
        Versions of the Lorem ipsum text have been used in typesetting at least since the 1960s, when it was popularized by advertisements for Letraset transfer sheets.[1] Lorem ipsum was introduced to the digital world in the mid-1980s, when Aldus employed it in graphic and word-processing templates for its desktop publishing program PageMaker. Other popular word processors, including Pages and Microsoft Word, have since adopted Lorem ipsum,[2] as have many LaTeX packages,[3][4][5] web content managers such as Joomla! and WordPress, and CSS libraries such as Semantic UI.[6]';

        // Seed 50 unique blog records
        for ($i = 0; $i < 50; $i++) {
            $blog = new Blog;
            $blog->category = $categories[rand(0, count($categories) - 1)];
            $blog->title = 'Blog Title ' . ($i + 1);
            $blog->content = $sampleContent;
            implode(',', (array)$tags);
            $blog->user_id = $userIds->random();
            $blog->save();
        }
    }
}
