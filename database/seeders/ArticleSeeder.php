<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a default author
        $author = User::first() ?? User::create([
            'name' => 'Glints Team',
            'email' => 'team@glints.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $articles = [
            [
                'title' => '10 Tips Menulis CV yang Menarik Perhatian HRD',
                'excerpt' => 'Pelajari cara membuat CV yang menonjol dan menarik perhatian recruiter dengan tips praktis dari para ahli HR.',
                'content' => "Menulis CV yang baik adalah kunci untuk mendapatkan pekerjaan impian Anda. Berikut adalah 10 tips yang dapat membantu CV Anda menonjol:\n\n1. **Gunakan Format yang Bersih dan Profesional**\nPilih template yang sederhana namun menarik. Hindari penggunaan font yang terlalu dekoratif atau warna yang mencolok.\n\n2. **Tulis Ringkasan Profesional yang Kuat**\nBuat ringkasan singkat di bagian atas CV yang menjelaskan siapa Anda dan apa yang Anda tawarkan.\n\n3. **Sesuaikan dengan Posisi yang Dilamar**\nCustomize CV Anda untuk setiap aplikasi pekerjaan. Highlight pengalaman dan skill yang relevan.\n\n4. **Gunakan Action Words**\nMulai setiap bullet point dengan kata kerja yang kuat seperti 'mengembangkan', 'memimpin', 'meningkatkan'.\n\n5. **Quantify Achievements**\nSertakan angka dan data untuk menunjukkan dampak dari pekerjaan Anda.\n\n6. **Keep It Concise**\nUsahakan CV tidak lebih dari 2 halaman, kecuali untuk posisi senior.\n\n7. **Proofread Carefully**\nPastikan tidak ada typo atau kesalahan grammar.\n\n8. **Include Relevant Keywords**\nGunakan kata kunci yang relevan dengan industri dan posisi yang Anda lamar.\n\n9. **Show, Don't Just Tell**\nBerikan contoh konkret dari pencapaian Anda.\n\n10. **Update Regularly**\nSelalu perbarui CV Anda dengan pengalaman dan skill terbaru.",
                'category' => 'CV & Resume',
                'tags' => ['CV Tips', 'Job Application', 'Career Advice', 'Resume Writing'],
                'read_time' => 8,
                'views' => 1250,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Cara Menghadapi Interview Kerja dengan Percaya Diri',
                'excerpt' => 'Tips dan strategi untuk menghadapi interview kerja agar Anda tampil percaya diri dan memberikan kesan terbaik.',
                'content' => "Interview kerja seringkali menjadi momen yang menentukan dalam proses pencarian kerja. Berikut tips untuk menghadapinya dengan percaya diri:\n\n**Persiapan Sebelum Interview**\n\n1. **Riset Perusahaan**\nPelajari tentang perusahaan, visi misi, produk/layanan, dan budaya kerja mereka.\n\n2. **Pahami Job Description**\nBaca kembali job description dan siapkan contoh pengalaman yang relevan.\n\n3. **Latihan Menjawab Pertanyaan Umum**\nSiapkan jawaban untuk pertanyaan seperti 'Ceritakan tentang diri Anda' dan 'Mengapa Anda tertarik dengan posisi ini?'\n\n**Saat Interview**\n\n1. **Datang Tepat Waktu**\nUsahakan datang 10-15 menit sebelum waktu yang ditentukan.\n\n2. **Berpakaian Profesional**\nSesuaikan dress code dengan budaya perusahaan.\n\n3. **Maintain Eye Contact**\nTunjukkan kepercayaan diri dengan kontak mata yang baik.\n\n4. **Listen Actively**\nDengarkan pertanyaan dengan seksama sebelum menjawab.\n\n5. **Ask Questions**\nSiapkan pertanyaan yang menunjukkan ketertarikan Anda pada posisi dan perusahaan.\n\n**Setelah Interview**\n\nKirim thank you email dalam 24 jam setelah interview untuk menunjukkan apresiasi dan menegaskan ketertarikan Anda.",
                'category' => 'Interview',
                'tags' => ['Interview Tips', 'Job Interview', 'Career Preparation', 'Confidence'],
                'read_time' => 6,
                'views' => 980,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Skill yang Paling Dicari Perusahaan di Era Digital',
                'excerpt' => 'Ketahui skill-skill yang paling dibutuhkan di dunia kerja modern dan bagaimana cara mengembangkannya.',
                'content' => "Era digital telah mengubah lanskap dunia kerja. Berikut adalah skill yang paling dicari perusahaan saat ini:\n\n**Technical Skills**\n\n1. **Data Analysis**\nKemampuan menganalisis dan menginterpretasi data menjadi insight yang actionable.\n\n2. **Digital Marketing**\nPemahaman tentang SEO, SEM, social media marketing, dan content marketing.\n\n3. **Programming**\nBahasa pemrograman seperti Python, JavaScript, dan SQL sangat diminati.\n\n4. **Cloud Computing**\nPengetahuan tentang AWS, Google Cloud, atau Azure.\n\n**Soft Skills**\n\n1. **Critical Thinking**\nKemampuan menganalisis masalah dan menemukan solusi kreatif.\n\n2. **Communication**\nSkill komunikasi yang baik, baik verbal maupun tertulis.\n\n3. **Adaptability**\nKemampuan beradaptasi dengan perubahan teknologi dan lingkungan kerja.\n\n4. **Leadership**\nKemampuan memimpin tim dan menginspirasi orang lain.\n\n**Cara Mengembangkan Skill**\n\n1. **Online Learning**\nManfaatkan platform seperti Coursera, Udemy, atau LinkedIn Learning.\n\n2. **Practice Projects**\nBuat project pribadi untuk mempraktikkan skill yang dipelajari.\n\n3. **Networking**\nBergabung dengan komunitas profesional di bidang Anda.\n\n4. **Continuous Learning**\nSelalu update dengan tren terbaru di industri Anda.",
                'category' => 'Skill Development',
                'tags' => ['Digital Skills', 'Career Development', 'Future of Work', 'Professional Growth'],
                'read_time' => 7,
                'views' => 1450,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Strategi Negosiasi Gaji yang Efektif',
                'excerpt' => 'Pelajari cara bernegosiasi gaji dengan tepat untuk mendapatkan kompensasi yang sesuai dengan nilai Anda.',
                'content' => "Negosiasi gaji adalah skill penting yang harus dikuasai setiap profesional. Berikut strateginya:\n\n**Persiapan Sebelum Negosiasi**\n\n1. **Research Market Rate**\nCari tahu standar gaji untuk posisi serupa di industri dan lokasi yang sama.\n\n2. **Document Your Value**\nBuat list pencapaian dan kontribusi Anda terhadap perusahaan.\n\n3. **Know Your Worth**\nHitung total value yang Anda berikan, termasuk cost savings dan revenue generation.\n\n**Timing yang Tepat**\n\n1. **Performance Review**\nManfaatkan momen performance review tahunan.\n\n2. **After Major Achievement**\nSetelah menyelesaikan project besar atau mencapai target penting.\n\n3. **Job Offer Negotiation**\nSaat menerima job offer dari perusahaan baru.\n\n**Teknik Negosiasi**\n\n1. **Start with Non-Salary Benefits**\nMulai dengan benefit lain seperti flexible working, training budget, atau additional leave.\n\n2. **Present Data, Not Emotions**\nGunakan data dan fakta, bukan perasaan pribadi.\n\n3. **Be Collaborative**\nFraming negosiasi sebagai diskusi win-win solution.\n\n4. **Have Alternatives**\nSiapkan BATNA (Best Alternative to Negotiated Agreement).\n\n**Yang Harus Dihindari**\n\n- Jangan membandingkan dengan rekan kerja\n- Jangan mengancam untuk resign\n- Jangan negosiasi saat emosi\n- Jangan menerima atau menolak langsung\n\nIngat, negosiasi adalah proses, bukan event satu kali.",
                'category' => 'Salary & Benefits',
                'tags' => ['Salary Negotiation', 'Career Advancement', 'Professional Development', 'Compensation'],
                'read_time' => 9,
                'views' => 2100,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Work-Life Balance: Mitos atau Realita?',
                'excerpt' => 'Eksplorasi mendalam tentang konsep work-life balance dan bagaimana mencapainya di era modern.',
                'content' => "Work-life balance telah menjadi topik hangat dalam diskusi dunia kerja modern. Namun, apakah ini benar-benar achievable?\n\n**Mengapa Work-Life Balance Penting**\n\n1. **Mental Health**\nMenjaga kesehatan mental dan mencegah burnout.\n\n2. **Productivity**\nKaryawan yang seimbang cenderung lebih produktif dan kreatif.\n\n3. **Relationships**\nMenjaga hubungan dengan keluarga dan teman.\n\n4. **Personal Growth**\nWaktu untuk hobi dan pengembangan diri.\n\n**Tantangan dalam Mencapai Balance**\n\n1. **Technology**\nSmartphone dan laptop membuat kita selalu 'connected' dengan pekerjaan.\n\n2. **Company Culture**\nBudaya perusahaan yang mengharapkan availability 24/7.\n\n3. **Economic Pressure**\nTekanan finansial yang membuat orang bekerja lebih keras.\n\n4. **Career Ambition**\nKeinginan untuk maju dalam karir.\n\n**Strategi Mencapai Balance**\n\n1. **Set Boundaries**\nTentukan jam kerja yang jelas dan stick to it.\n\n2. **Prioritize Tasks**\nFokus pada tugas yang benar-benar penting dan urgent.\n\n3. **Learn to Say No**\nJangan takut menolak request yang tidak essential.\n\n4. **Use Technology Wisely**\nManfaatkan tools untuk automation dan efficiency.\n\n5. **Take Breaks**\nSchedule regular breaks dan vacation time.\n\n**Work-Life Integration vs Balance**\n\nMungkin konsep yang lebih realistis adalah work-life integration - di mana work dan life saling melengkapi, bukan competing against each other.\n\nKuncinya adalah menemukan rhythm yang works untuk Anda personally.",
                'category' => 'Dunia Kerja',
                'tags' => ['Work Life Balance', 'Mental Health', 'Productivity', 'Lifestyle'],
                'read_time' => 8,
                'views' => 1680,
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Remote Work: Tips Produktif Bekerja dari Rumah',
                'excerpt' => 'Panduan lengkap untuk tetap produktif dan profesional saat bekerja dari rumah.',
                'content' => "Remote work telah menjadi new normal bagi banyak perusahaan. Berikut tips untuk sukses bekerja dari rumah:\n\n**Setup Workspace yang Ideal**\n\n1. **Dedicated Space**\nSediakan ruang khusus untuk bekerja, terpisah dari area istirahat.\n\n2. **Ergonomic Setup**\nInvestasi dalam kursi dan meja yang ergonomis.\n\n3. **Good Lighting**\nPastikan pencahayaan yang cukup, idealnya natural light.\n\n4. **Minimize Distractions**\nJauhkan TV, game console, atau distraksi lainnya.\n\n**Maintain Routine**\n\n1. **Set Schedule**\nBuat jadwal kerja yang konsisten.\n\n2. **Morning Routine**\nMulai hari dengan routine yang sama seperti saat ke kantor.\n\n3. **Dress for Success**\nBerpakaian seperti akan ke kantor, meski di rumah.\n\n4. **Take Breaks**\nSchedule break time seperti di kantor.\n\n**Communication & Collaboration**\n\n1. **Over-communicate**\nKomunikasi lebih sering dan jelas dengan tim.\n\n2. **Use Right Tools**\nManfaatkan Slack, Zoom, Trello, atau tools kolaborasi lainnya.\n\n3. **Regular Check-ins**\nSchedule regular one-on-one dengan manager.\n\n4. **Virtual Coffee Breaks**\nMaintain social connection dengan colleagues.\n\n**Productivity Tips**\n\n1. **Time Blocking**\nAlokasikan waktu spesifik untuk different tasks.\n\n2. **Pomodoro Technique**\nKerja 25 menit, istirahat 5 menit.\n\n3. **Eliminate Multitasking**\nFokus pada satu task at a time.\n\n4. **End-of-Day Ritual**\nBuat ritual untuk 'menutup' hari kerja.\n\n**Challenges & Solutions**\n\n- **Isolation**: Join virtual coworking sessions\n- **Distractions**: Use website blockers\n- **Overworking**: Set strict boundaries\n- **Communication gaps**: Schedule regular updates\n\nRemote work requires discipline, but with right strategies, it can be more productive than office work.",
                'category' => 'Tips Karir',
                'tags' => ['Remote Work', 'Productivity', 'Work From Home', 'Digital Nomad'],
                'read_time' => 10,
                'views' => 1890,
                'published_at' => now()->subDays(15),
            ]
        ];

        foreach ($articles as $articleData) {
            Article::create([
                'title' => $articleData['title'],
                'slug' => Str::slug($articleData['title']),
                'excerpt' => $articleData['excerpt'],
                'content' => $articleData['content'],
                'category' => $articleData['category'],
                'tags' => $articleData['tags'],
                'author_id' => $author->id,
                'read_time' => $articleData['read_time'],
                'views' => $articleData['views'],
                'is_published' => true,
                'published_at' => $articleData['published_at'],
            ]);
        }
    }
}