<?php
require_once 'config.php';

$searchType = isset($_GET['search_type']) ? $_GET['search_type'] : 'nama_siswa';
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'id_siswa';
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';

$newSortOrder = ($sortOrder == 'ASC') ? 'DESC' : 'ASC';

$sql = "SELECT * FROM siswa WHERE 1=1";
if ($searchQuery != '') {
    $sql .= " AND $searchType LIKE :search";
}
$sql .= " ORDER BY $sortColumn $sortOrder";

$stmt = $pdo->prepare($sql);
if ($searchQuery != '') {
    $stmt->bindValue(':search', "%$searchQuery%", PDO::PARAM_STR);
}
$stmt->execute();
$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengelolaan Data Siswa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f2f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            padding: 2rem;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .search-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .search-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .search-form select,
        .search-form input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            flex: 1;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #6366f1;
            color: white;
        }

        .btn-primary:hover {
            background-color: #4f46e5;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8fafc;
            color: #4b5563;
        }

        tr:hover {
            background-color: #f8fafc;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .btn-edit {
            background-color: #10b981;
            color: white;
        }

        .btn-delete {
            background-color: #ef4444;
            color: white;
        }

        .btn-edit:hover,
        .btn-delete:hover {
            opacity: 0.9;
        }

        .sort-header {
            cursor: pointer;
            position: relative;
            padding-right: 20px;
        }

        .sort-header:hover {
            background-color: #f0f2f5;
        }

        .sort-icon {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.5;
        }

        .sort-header:hover .sort-icon {
            opacity: 1;
        }

        .active-sort {
            background-color: #f0f2f5;
        }

        .active-sort .sort-icon {
            opacity: 1;
            color: #6366f1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Sistem Pengelolaan Data Siswa</h1>
            <p>Kelola data siswa dengan mudah dan efisien</p>
        </div>

        <div class="search-section">
            <form class="search-form" method="GET">
                <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sortColumn); ?>">
                <input type="hidden" name="order" value="<?php echo htmlspecialchars($sortOrder); ?>">
                <select name="search_type">
                    <option value="nama_siswa" <?php echo $searchType == 'nama_siswa' ? 'selected' : ''; ?>>Nama Siswa</option>
                    <option value="kelas" <?php echo $searchType == 'kelas' ? 'selected' : ''; ?>>Kelas</option>
                    <option value="jurusan" <?php echo $searchType == 'jurusan' ? 'selected' : ''; ?>>Jurusan</option>
                </select>
                <input type="text" name="search" placeholder="Cari..." value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Cari
                </button>
                <a href="tambah.php" class="btn btn-primary" style="text-decoration: none;">
                    <i class="fas fa-plus"></i> Tambah Siswa
                </a>
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <?php
                        $columns = [
                            'id_siswa' => 'ID',
                            'nama_siswa' => 'Nama Siswa',
                            'kelas' => 'Kelas',
                            'jurusan' => 'Jurusan',
                            'tanggal_lahir' => 'Tanggal Lahir'
                        ];

                        foreach ($columns as $column => $label) {
                            $isActiveSort = $sortColumn == $column;
                            $columnSortOrder = $isActiveSort ? $newSortOrder : 'ASC';
                            $sortIconClass = $isActiveSort ?
                                ($sortOrder == 'ASC' ? 'fa-sort-up' : 'fa-sort-down') :
                                'fa-sort';
                        ?>
                            <th class="sort-header <?php echo $isActiveSort ? 'active-sort' : ''; ?>"
                                onclick="window.location.href='?sort=<?php echo $column; ?>&order=<?php echo $columnSortOrder; ?>&search_type=<?php echo $searchType; ?>&search=<?php echo urlencode($searchQuery); ?>'">
                                <?php echo $label; ?>
                                <i class="fas <?php echo $sortIconClass; ?> sort-icon"></i>
                            </th>
                        <?php } ?>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['id_siswa']); ?></td>
                            <td><?php echo htmlspecialchars($student['nama_siswa']); ?></td>
                            <td><?php echo htmlspecialchars($student['kelas']); ?></td>
                            <td><?php echo htmlspecialchars($student['jurusan']); ?></td>
                            <td><?php echo htmlspecialchars($student['tanggal_lahir']); ?></td>
                            <td class="action-buttons">
                                <a href="edit.php?id=<?php echo $student['id_siswa']; ?>" class="btn btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="hapus.php?id=<?php echo $student['id_siswa']; ?>" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>