<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'PHP',
            'Laravel',
            'JavaScript',
            'React',
            'Vue.js',
            'Angular',
            'Node.js',
            'Python',
            'Django',
            'Ruby',
            'Ruby on Rails',
            'Java',
            'Spring Boot',
            'C#',
            '.NET',
            'SQL',
            'MySQL',
            'PostgreSQL',
            'MongoDB',
            'Redis',
            'HTML',
            'CSS',
            'Tailwind CSS',
            'Bootstrap',
            'Git',
            'Docker',
            'AWS',
            'Azure',
            'Google Cloud',
            'Linux',
            'Windows',
            'MacOS',
            'Agile',
            'Scrum',
            'Project Management',
            'UI/UX Design',
            'Figma',
            'Adobe Photoshop',
            'Adobe Illustrator',
            'Adobe XD',
            'Content Writing',
            'SEO',
            'Digital Marketing',
            'Social Media Marketing',
            'Email Marketing',
            'Data Analysis',
            'Machine Learning',
            'Artificial Intelligence',
            'Blockchain',
            'Cybersecurity',
        ];

        foreach ($skills as $skill) {
            Skill::create(['name' => $skill]);
        }
    }
}