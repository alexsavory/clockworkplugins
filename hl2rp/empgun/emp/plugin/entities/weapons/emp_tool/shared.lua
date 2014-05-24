// Variables that are used on both client and server
 
SWEP.PrintName      = "Prototype EMP Tool"     
SWEP.Slot            = 1
SWEP.SlotPos            = 1
SWEP.DrawAmmo         = false
SWEP.DrawCrosshair    = true
SWEP.ViewModelFOV   = 70
 
SWEP.Author   = ""
SWEP.Contact        = ""
SWEP.Purpose        = "A small device filled with electricity."
SWEP.Instructions   = "Primary to send a charge of electromagnetic pulse. The device doesn't look stable."
 
SWEP.Spawnable      = false
SWEP.AdminSpawnable  = true      // Spawnable in singleplayer or by server admins
 
SWEP.ViewModel      = "models/weapons/v_alyx_emptool.mdl"
SWEP.WorldModel   = "models/weapons/w_emptool.mdl"

util.PrecacheModel("models/alyx_emptool_prop.mdl")
 
SWEP.Primary.ClipSize      = -1
SWEP.Primary.DefaultClip    = -1
SWEP.Primary.Automatic    = false
SWEP.Primary.Ammo         = "none"
 SWEP.Primary.Delay = 1
SWEP.Secondary.ClipSize  = -1
SWEP.Secondary.DefaultClip  = -1
SWEP.Secondary.Automatic    = false
SWEP.Secondary.Ammo   = "none"
 
local ShootSound = Sound( "AlyxEMP.Discharge" )
//local ShootSound = Sound( "vo/npc/alyx/hurt05.wav" )

/*---------------------------------------------------------
    Initialize - Setting hold type
---------------------------------------------------------*/
function SWEP:Initialize()

    self:SetWeaponHoldType( "slam" )
    
end
 
/*---------------------------------------------------------
   Think does nothing
---------------------------------------------------------*/
function SWEP:Think()
end
 
 
/*---------------------------------------------------------
    PrimaryAttack - Everyone loves orange
---------------------------------------------------------*/
function SWEP:PrimaryAttack()
    self:SetNextPrimaryFire(CurTime() + self.Primary.Delay);
    self:SetNextSecondaryFire(CurTime() + self.Primary.Delay);
 
//Rollermine detection :O
    local tr = self.Owner:GetEyeTrace() -- What's he looking at
if tr.HitWorld then return end --Dont turn the world invisible! Unfortunately
 
//Sounds messages and uh blah
 
 
   
    self.Weapon:EmitSound( ShootSound )
    self.Weapon:SendWeaponAnim( ACT_VM_FIDGET )
    
    // The rest is only done on the server
    if (!SERVER) then return end
   
 UseEMP(self.Owner, self,tr,tr.Entity)
 
end
/*---------------------------------------------------------
    SecondaryAttack - Back to blue
---------------------------------------------------------*/
  