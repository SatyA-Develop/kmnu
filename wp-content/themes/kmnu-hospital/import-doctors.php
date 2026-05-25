<?php
/**
 * Import doctors from JS array provided by user.
 */

// Bootstrap WordPress
define('WP_USE_THEMES', false);
require_once(__DIR__ . '/../../../wp-load.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');

$allDoctors = [
  [
    'name' => "Dr. Ramprasad Ramalingam",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\DrRamprasadRamlingam.png",
    'qualification' => "MBBS, MD (Gen-Medicine), DNB (Nephrology)",
    'department' => "Nephrology",
    'profile' => "Sr. Consultant Nephrologist & Transplant Physician - Dept of Nephrology, NU Hospitals",
    'profile_url' => "/doctors/dr-ramprasad-ramalingam"
  ],
  [
    'name' => "Dr. Shakuntala V Modi",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\DrShankunthal1.png",
    'qualification' => "MBBS, MD, Fellowship in Nephrology",
    'department' => "Nephrology",
    'profile' => "Consultant Nephrologist & Transplany Physician - Dept of Nephrology, NU Hospitals",
    'profile_url' => "/doctors/dr-shakuntala-v-modi"
  ],
  [
    'name' => "Dr. Nitin Nayak M",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\DrNitinNayak.png",
    'qualification' => "MBBS, DCH, DNB (Paediatrics), Fellowship in Paediatric Nephrology",
    'department' => "Nephrology",
    'profile' => "Consultant Paediatric Nephrologist & Transplant Physician - Dept of Nephrology, NU Hospitals",
    'profile_url' => "/doctors/dr-nitin-nayak-m"
  ],
  [
    'name' => "Dr. Aashish S",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\dr_Ashish_latest.png",
    'qualification' => "MBBS, MD (Gen-Medicine), DM (Nephrology)",
    'department' => "Nephrology",
    'profile' => "Consultant Nephrologist & Transplant Physician - Dept of Nephrology, NU Hospitals",
    'profile_url' => "/doctors/dr-aashish-s"
  ],
  [
    'name' => "Dr. Nikhil J Elenjickal",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\nikhil_elen.png",
    'qualification' => "M.B.B.S, M.D. (Medicine), DNB Nephrology, MNAMS, ESE-Neph (MRCP Nephrology)",
    'department' => "Nephrology",
    'profile' => "Nephrologist & Transplant Physician - Dept of Nephrology, NU Hospitals",
    'profile_url' => "/doctors/dr-nikhilj-elenjickal"
  ],
  [
    'name' => "Dr. S Fasiulla",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\Dr.Fasiulla_new.png",
    'qualification' => "MBBS, MS (Gen. Surgery), FMIS, FRGUHS",
    'department' => "General Surgery",
    'profile' => "Consultant General & Laparoscopic Surgeon Endoscopy Specialist, KM NU Hospitals, Ambur",
    'profile_url' => "/doctors/dr-fasiulla"
  ],
  [
    'name' => "Dr. Kathirazhagan Thulasilingam",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\dr-kathirazhagan-thulasilingam.jpg",
    'qualification' => "MBBS, DNB in General Surgery, with fellowship (FIAGES)",
    'department' => "General Surgery",
    'profile' => "General Surgeon",
    'profile_url' => "/doctors/dr-kathirazhagan-thulasilingam"
  ],
  [
    'name' => "Dr. A. Kiran Kumar",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\dr-a-kiran-kumar.png",
    'qualification' => "MBBS, DNB (Orthopaedics)",
    'department' => "Orthopaedics",
    'profile' => "Consultant orthopaedics and Joint Replacement Surgeon",
    'profile_url' => "/doctors/dr-a-kiran-kumar"
  ],
  [
    'name' => "Dr. Prasanna Venkatesh M. K.",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\DrPrasannaVenkatesh-(1).png",
    'qualification' => "MBBS, MS, DNB (Gen-Surgery), DNB (Urology) Fellow (Paediatric Urology)",
    'department' => "Urology",
    'profile' => "Sr. Consultant Paediatric Urologist & Managing Director, KM NU Hospitals",
    'profile_url' => "/doctors/dr-prasanna-venkatesh-m-k"
  ],
  [
    'name' => "Dr. Maneesh Sinha",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\DrManeeshSinha-(1).png",
    'qualification' => "MBBS, MS (Gen-Surgery), DNB (Urology), MCh (Urology)",
    'department' => "Urology",
    'profile' => "Sr. Consultant Urologist - Head of Department of Urology, KM NU Hospitals",
    'profile_url' => "/doctors/dr-maneesh-sinha"
  ],
  [
    'name' => "Dr. Nagarjuna Reddy Danduri",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\dr-nagarjuna-reddy-danduri.png",
    'qualification' => "MBBS, DNB(Surgery), DrNB(Urology)",
    'department' => "Urology",
    'profile' => "Urologist - Dept. of Urology, NU Hospitals Padmanabhanagar",
    'profile_url' => "/doctors/dr-nagarjuna-reddy-danduri"
  ],
  [
    'name' => "Dr. Pramod Krishnappa",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\dr-pramod-krishnappa.png",
    'qualification' => "MBBS, MS (Gen-Surgery), DNB (Urology), ESSM Penile Implant Fellowship (Spain)",
    'department' => "Andrology",
    'profile' => "Consultant Andrologist – Dept. of Urology, KM NU Hospitals",
    'profile_url' => "/doctors/dr-pramod-krishnappa"
  ],
  [
    'name' => "Dr. Vinod Kumar P.",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\DrVinodKumarPic-(1).png",
    'qualification' => "MBBS, MS (Gen-Surgery), DNB (Urology)",
    'department' => "Urology",
    'profile' => "Consultant Urologist – Dept. of Urology, KM NU Hospitals",
    'profile_url' => "/doctors/dr-vinod-kumar-p"
  ],
  [
    'name' => "Dr. Avinaash K Raghupathy",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\dr-avinaash-k-raghupathy.jpg",
    'qualification' => "MBBS",
    'department' => "Emergency Medicine",
    'profile' => "Emergency medicine and critical care specialist",
    'profile_url' => "/doctors/dr-avinaash-k-raghupathy"
  ],
  [
    'name' => "Dr. Aravindan CG",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\dr-aravindan-cg.jpeg",
    'qualification' => "MBBS, MD Anaesthesiology and Critical care",
    'department' => "Anaesthesiology",
    'profile' => "Anaesthesiology",
    'profile_url' => "/doctors/dr-aravindan-cg"
  ],
  [
    'name' => "Dr. Madan Gopi. P M.S",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\dr-madan-gopi.jpg",
    'qualification' => "MBBS, M.S. (Otorhinolaryngology)",
    'department' => "ENT",
    'profile' => "Consultant - ENT",
    'profile_url' => "/doctors/dr-madan-gopi"
  ],
  [
    'name' => "Dr. Manu Thampi",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\dr-manu-thampi.jpeg",
    'qualification' => "MBBS, MS (ENT), DNB (Otorhinolaryngology), Post Doctoral Fellowship (Rhinology)",
    'department' => "ENT",
    'profile' => "ENT Surgeon",
    'profile_url' => "/doctors/dr-manu-thampi"
  ],
  [
    'name' => "Dr. Swathi Matippa",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\Swathi.png",
    'qualification' => "MBBS, MD (Radiodiagnosis), FRCR (UK), Fellowship in Abdominal Imaging & Interventions",
    'department' => "Uroradiology Tests",
    'profile' => "Sr. Consultant Radiologist - Head of Dept. of Radiodiagnosis, NU Hospitals",
    'profile_url' => "/doctors/dr-swathi-matippa"
  ],
  [
    'name' => "Dr. Md. Qamar Shadab",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\202-px_0000_Dr.-Md-Qamar-Shadab.png",
    'qualification' => "MBBS, PGDS",
    'department' => "Uroradiology Tests",
    'profile' => "Sr. Consultant Sonologist, KM NU Hospitals, Ambur",
    'profile_url' => "/doctors/dr-md-qamar-shadab"
  ],
  [
    'name' => "Dr. Sneha J",
    'image' => "C:\\xampp\\htdocs\\KMNU\\wp-content\\themes\\kmnu-hospital\\doctors\\Dr-Sneha-old.jpg",
    'qualification' => "MBBS, MD (OBG) AIIMS, DNB (OBG), FIRM (Fellowship in Reproductive Medicine)",
    'department' => "IVF",
    'profile' => "Sr. Consultant - Reproductive Medicine, Female Sexual Health & Gynaecologist",
    'profile_url' => "https://www.nufertility.com/dr-sneha-j"
  ]
];

foreach ($allDoctors as $doc) {
    echo "Processing " . $doc['name'] . "...\n";

    // Check if post exists
    $existing = get_page_by_title($doc['name'], OBJECT, 'doctors');

    $post_data = [
        'post_title'   => $doc['name'],
        'post_status'  => 'publish',
        'post_type'    => 'doctors',
        'post_content' => $doc['profile'], // Using profile as content
    ];

    if ($existing) {
        $post_id = $existing->ID;
        $post_data['ID'] = $post_id;
        wp_update_post($post_data);
        echo "Updated existing doctor ID: $post_id\n";
    } else {
        $post_id = wp_insert_post($post_data);
        echo "Created new doctor ID: $post_id\n";
    }

    if (is_wp_error($post_id)) {
        echo "Error creating post: " . $post_id->get_error_message() . "\n";
        continue;
    }

    // Set Meta Fields
    update_post_meta($post_id, 'qualification', $doc['qualification']);
    update_post_meta($post_id, 'profile', $doc['profile']); // redundant if in content, but user asked for fields
    update_post_meta($post_id, 'profile_url', $doc['profile_url']);

    // Handle Taxonomy: specialization (linked to department)
    if (!empty($doc['department'])) {
        $term = term_exists($doc['department'], 'specialization');
        if (!$term) {
            $term = wp_insert_term($doc['department'], 'specialization');
        }
        if (!is_wp_error($term)) {
            $term_id = is_array($term) ? $term['term_id'] : $term;
            wp_set_object_terms($post_id, (int)$term_id, 'specialization');
            echo "Set specialization: " . $doc['department'] . "\n";
        }
    }

    // Handle Image
    if (!empty($doc['image'])) {
        $image_path = $doc['image'];
        
        // Try fallback if original fails
        if (!file_exists($image_path)) {
             $fallback = str_replace('-old', '', $image_path);
             if (file_exists($fallback)) {
                 $image_path = $fallback;
             }
        }

        if (file_exists($image_path)) {
            // Only upload if no featured image set
            if (!has_post_thumbnail($post_id)) {
                $filename = basename($image_path);
                $upload_file = wp_upload_bits($filename, null, file_get_contents($image_path));
                
                if (!$upload_file['error']) {
                    $wp_filetype = wp_check_filetype($filename, null );
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );
                    $attachment_id = wp_insert_attachment($attachment, $upload_file['file'], $post_id);
                    $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload_file['file']);
                    wp_update_attachment_metadata($attachment_id, $attachment_data);
                    set_post_thumbnail($post_id, $attachment_id);
                    echo "Profile image uploaded and set: $filename\n";
                } else {
                    echo "Error uploading image: " . $upload_file['error'] . "\n";
                }
            } else {
                echo "Featured image already exists.\n";
            }
        } else {
            echo "Image file not found even after fallback: " . $doc['image'] . "\n";
        }
    } else {
        echo "No image path provided for " . $doc['name'] . "\n";
    }
    echo "-------------------\n";
}

echo "Import complete.";
