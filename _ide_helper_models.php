<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Kelas
 *
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas whereUpdatedAt($value)
 */
	class Kelas extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Mapel
 *
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Mapel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mapel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mapel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mapel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mapel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mapel whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mapel whereUpdatedAt($value)
 */
	class Mapel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaketSoal
 *
 * @property int $id
 * @property string|null $kode_paket
 * @property string $nama
 * @property string|null $keterangan
 * @property int $kelas_id
 * @property int $mapel_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kelas $kelas
 * @property-read \App\Models\Mapel $mapel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Soal[] $soal
 * @property-read int|null $soal_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ujian[] $ujian
 * @property-read int|null $ujian_count
 * @method static \Illuminate\Database\Eloquent\Builder|PaketSoal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaketSoal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaketSoal query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaketSoal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketSoal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketSoal whereKelasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketSoal whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketSoal whereKodePaket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketSoal whereMapelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketSoal whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaketSoal whereUpdatedAt($value)
 */
	class PaketSoal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pengaturan
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan query()
 */
	class Pengaturan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Siswa
 *
 * @property int $id
 * @property string $nama
 * @property string $nis
 * @property string $password
 * @property int $kelas_id
 * @property string|null $api_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kelas $kelas
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UjianSiswa[] $ujian_siswa
 * @property-read int|null $ujian_siswa_count
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereKelasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereNis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereUpdatedAt($value)
 */
	class Siswa extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Soal
 *
 * @property int $id
 * @property int|null $paket_soal_id
 * @property string $jenis
 * @property string|null $nama
 * @property string $soal
 * @property string|null $media
 * @property int $kelas_id
 * @property int $mapel_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kelas $kelas
 * @property-read \App\Models\Mapel $mapel
 * @property-read \App\Models\PaketSoal|null $paket_soal
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SoalJawaban[] $soal_jawaban
 * @property-read int|null $soal_jawaban_count
 * @method static \Illuminate\Database\Eloquent\Builder|Soal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Soal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Soal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Soal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soal whereJenis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soal whereKelasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soal whereMapelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soal whereMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soal whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soal wherePaketSoalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soal whereSoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soal whereUpdatedAt($value)
 */
	class Soal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SoalJawaban
 *
 * @property int $id
 * @property int $soal_id
 * @property string $jawaban
 * @property string|null $media
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Soal $soal
 * @method static \Illuminate\Database\Eloquent\Builder|SoalJawaban newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SoalJawaban newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SoalJawaban query()
 * @method static \Illuminate\Database\Eloquent\Builder|SoalJawaban whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoalJawaban whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoalJawaban whereJawaban($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoalJawaban whereMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoalJawaban whereSoalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoalJawaban whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoalJawaban whereUpdatedAt($value)
 */
	class SoalJawaban extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ujian
 *
 * @property int $id
 * @property int|null $kelas_id
 * @property int|null $paket_soal_id
 * @property string $nama
 * @property string|null $keterangan
 * @property string $waktu_mulai
 * @property int $waktu_ujian
 * @property string|null $token
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kelas|null $kelas
 * @property-read \App\Models\PaketSoal|null $paket_soal
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UjianSiswa[] $ujian_siswa
 * @property-read int|null $ujian_siswa_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian whereKelasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian wherePaketSoalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian whereWaktuMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ujian whereWaktuUjian($value)
 */
	class Ujian extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UjianSiswa
 *
 * @property int $id
 * @property int $ujian_id
 * @property int $siswa_id
 * @property string|null $soal soal ujian
 * @property string $waktu_mulai
 * @property string|null $waktu_selesai
 * @property string|null $hasil hasil ujian
 * @property float|null $nilai
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Siswa $siswa
 * @property-read \App\Models\Ujian $ujian
 * @method static \Illuminate\Database\Eloquent\Builder|UjianSiswa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UjianSiswa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UjianSiswa query()
 * @method static \Illuminate\Database\Eloquent\Builder|UjianSiswa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UjianSiswa whereHasil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UjianSiswa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UjianSiswa whereNilai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UjianSiswa whereSiswaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UjianSiswa whereSoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UjianSiswa whereUjianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UjianSiswa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UjianSiswa whereWaktuMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UjianSiswa whereWaktuSelesai($value)
 */
	class UjianSiswa extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property array $roles
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

