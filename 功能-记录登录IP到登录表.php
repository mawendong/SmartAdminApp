laravel中记录用户登录时的IP，并写入登录记录表，用户表users，登录记录表login_logs。俩表之间的关联字段是user_id，并且已安装 Laravel Breeze套件。请集合 Laravel Breeze 套件的代码给出一套完整的实现代码，请注意只在登录时记录IP，不是每个页面请求记录IP。


Laravel Breeze 环境下记录用户登录 IP 的完整实现
    理解需求
    目标: 在用户登录时记录登录 IP，并将其写入 login_logs 表。
    数据表: users 表（用户表）、login_logs 表（登录日志表）。
    关联字段: user_id，用于关联用户与登录记录。
    框架: Laravel Breeze，提供了一套完善的用户认证系统。
    限制: 只在登录时记录 IP，避免每个页面请求都记录。

1. 创建 login_logs 表

运行以下命令创建登录日志表：php artisan make:migration create_login_logs_table //建立登录日志表
    //修改数据库迁移文件
    public function up(): void
    {
        Schema::create('login_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('ip_address')->nullable();  
            $table->timestamp('login_at')->useCurrent();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_logs');
    }

运行数据库迁移命令：php artisan migrate

2. LoginLog 模型

运行以下命令创建LoginLog模型：php artisan make:model LoginLog //创建LoginLog模型
    //在LoginLog模型中添加代码
    class LoginLog extends Model
    {
        use HasFactory;
        protected $table = 'login_logs';  
        protected $fillable = ['user_id', 'ip_address']; // 假设还有其他字段 
        public function user()  
        {  
            return $this->belongsTo(User::class, 'user_id'); // 注意这里的 'user_id'  
        } 
    }


3. 修改认证控制器
修改 app/Http/Controllers/Auth/AuthenticatedSessionController.php 
    增加 use App\Models\LoginLog; //引入LoginLog模型 
    // 修改 store 方法
    public function store(Request $request)
    {
        // 其它代码
        $request->authenticate();
        $request->session()->regenerate();
        //在登录成功后记录登录日志
        // 记录登录日志
        LoginLog::create([
            'user_id' => Auth::id(),
            'ip' => request()->ip(),
        ]);
    }





